<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Post;
use App\Models\PostChunk;
use App\Services\EmbeddingService;
use App\Support\TextChunker;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

/**
 * Job to index post content for RAG search.
 *
 * Processes a post's content into chunks, generates embeddings for each chunk
 * using Ollama, and stores them in the database for vector similarity search.
 */
class IndexPost implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     *
     * @param  Post  $post  The post to index
     */
    public function __construct(private Post $post) {}

    /**
     * Execute the job.
     *
     * Deletes existing chunks for this post and creates new ones with embeddings.
     *
     * @param  EmbeddingService  $embed  Service for generating embeddings
     */
    public function handle(EmbeddingService $embed): void
    {
        PostChunk::where('post_id', $this->post->id)->delete();

        foreach (TextChunker::chunk($this->post->content) as $chunk) {
            PostChunk::create([
                'post_id' => $this->post->id,
                'content' => $chunk,
                'embedding' => json_encode($embed->embed($chunk)),
            ]);
        }
    }
}
