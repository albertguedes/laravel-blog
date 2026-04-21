<?php

declare(strict_types=1);

namespace App\Services;

use Cloudstudio\Ollama\Facades\Ollama;

/**
 * RAG (Retrieval-Augmented Generation) service for answering blog questions.
 *
 * @author Albert
 *
 * @since 1.0.0
 */
class RAGService
{
    /**
     * Create a new RAG service instance.
     *
     * @param  BlogContextService  $blogContext  Service for blog metadata context
     * @param  EmbeddingService  $embeddingService  Service for text embeddings
     * @param  VectorSearchService  $vectorSearchService  Service for vector similarity search
     */
    public function __construct(
        private BlogContextService $blogContext,
        private EmbeddingService $embeddingService,
        private VectorSearchService $vectorSearchService
    ) {}

    /**
     * Answer a question using RAG approach.
     *
     * @param  string  $question  The question to answer
     * @return string The generated answer
     */
    public function answer(string $question): string
    {
        $blogContext = $this->blogContext->get();

        $questionVector = $this->embeddingService->embed($question);
        $chunks = $this->vectorSearchService->findSimilar($questionVector, 5);
        $context = $chunks->pluck('content')->implode("\n\n");

        $prompt = <<<PROMPT
INFORMAÇÕES FIXAS DO BLOG:
{$blogContext}

CONTEÚDO DO BLOG (TRECHOS RELEVANTES):
{$context}

REGRAS:
- Use apenas as informações acima.
- Se a resposta não estiver contida nelas, diga que não sabe.

PERGUNTA:
{$question}
PROMPT;

        $response = Ollama::agent('Você responde usando apenas o conteúdo fornecido.')
            ->prompt($prompt)
            ->model(config('ollama-laravel.model'))
            ->options(['temperature' => 0.2])
            ->ask();

        return $response['response'];
    }
}
