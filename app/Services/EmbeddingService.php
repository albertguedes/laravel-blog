<?php

declare(strict_types=1);

namespace App\Services;

use Cloudstudio\Ollama\Facades\Ollama;

/**
 * Service for generating text embeddings using Ollama.
 *
 * @author Albert
 *
 * @since 1.0.0
 */
class EmbeddingService
{
    /**
     * Generate embeddings for the given text.
     *
     * @param  string  $text  The text to embed
     * @return array The embedding vector
     */
    public function embed(string $text): array
    {
        // Use 'nomic-embed-text' model to get embeddings for RAG
        return Ollama::model('nomic-embed-text')
            ->embeddings($text);

    }
}
