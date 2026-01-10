<?php declare(strict_types=1);

namespace App\Services;

use App\Models\PostChunk;
use App\Support\Similarity;

class VectorSearchService
{
    public function __construct(
        private Similarity $similarity
    ) {}

    /**
     * Find similar post chunks based on the cosine similarity of the query vector and the post chunk embeddings.
     *
     * @param array $queryVector The query vector to compare with the post chunk embeddings.
     * @param int $limit The number of similar post chunks to return.
     * @return \Illuminate\Support\Collection A collection of post chunks with their scores, sorted in descending order of score and limited to the specified limit.
     */
    public function findSimilar(array $queryVector, int $limit = 5)
    {
        $embedding = $queryVector['embedding'];
        return PostChunk::all()
                        ->map(function ($chunk) use ($embedding) {

                            $chunk->score = $this->similarity->cosine(
                                $embedding,
                                json_decode($chunk->embedding, true)
                            );

                            return $chunk;
                        })
                        ->sortByDesc('score')
                        ->take($limit)
                        ->values();
    }
}
