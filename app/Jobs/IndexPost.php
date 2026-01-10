<?php declare(strict_types=1);

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Models\Post;
use App\Models\PostChunk;

use App\Services\EmbeddingService;
use App\Support\TextChunker;

class IndexPost implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct (private Post $post) {}

    /**
     * Execute the job.
     */
    public function handle(EmbeddingService $embed)
    {
        PostChunk::where('post_id', $this->post->id)->delete();

        foreach (TextChunker::chunk($this->post->content) as $chunk) {
            PostChunk::create([
                'post_id'   => $this->post->id,
                'content'   => $chunk,
                'embedding' => json_encode($embed->embed($chunk)),
            ]);
        }
    }
}
