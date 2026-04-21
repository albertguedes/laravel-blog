<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\PostChunk;
use App\Support\Similarity;
use Illuminate\Support\Collection;

class VectorSearchService
{
    /**
     * Create a new vector search service instance.
     *
     * @param  Similarity  $similarity  Similarity calculation service
     */
    public function __construct(
        private Similarity $similarity
    ) {}

    /**
     * Find similar post chunks based on cosine similarity.
     *
     * @param  array  $queryVector  The query vector to compare
     * @param  int  $limit  The number of results to return
     * @return Collection A collection of post chunks with scores
     */
    public function findSimilar(array $queryVector, int $limit = 5)
    {
        $embedding = $queryVector['embedding'];

        return PostChunk::all()
            ->map(function ($chunk) use ($embedding) {

                $chunk->score = $this->similarity->cosine(
                    $embedding,
                    json_decode($chunk->embedding, true)['embedding']
                );

                return $chunk;
            })
            ->sortByDesc('score')
            ->take($limit)
            ->values();
    }
}
