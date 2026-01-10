<?php declare(strict_types=1);

namespace App\Services;

use Cloudstudio\Ollama\Facades\Ollama;

class EmbeddingService
{
    public function embed(string $text): array
    {
        // Use 'nomic-embed-text' model to get embeddings for RAG
        return Ollama::model('nomic-embed-text')
                    ->embeddings($text);

    }
}
