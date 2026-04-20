<?php

declare(strict_types=1);

namespace App\Tools;

use App\Services\RAGService;

/**
 * Search posts tool for the chat agent.
 *
 * This tool wraps the RAG service to provide knowledge-based answers
 * about blog content. It searches post chunks for relevant information
 * and generates natural language responses.
 *
 * @category Tools
 */
class SearchPostsTool
{
    public function __construct(
        private RAGService $ragService
    ) {}

    /**
     * Search posts for relevant content and generate an answer.
     *
     * @param  string  $query  The search query about blog content
     * @return string Natural language answer based on post content
     */
    public function __invoke(string $query): string
    {
        return $this->ragService->answer($query);
    }

    /**
     * Search posts and return raw results.
     *
     * @param  string  $query  The search query
     * @return array<string, mixed> Search results with context
     */
    public function search(string $query): array
    {
        return [
            'query' => $query,
            'answer' => $this->ragService->answer($query),
        ];
    }
}
