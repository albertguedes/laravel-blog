<?php

declare(strict_types=1);

namespace App\Tools;

use App\Services\TextToSqlService;

/**
 * Query database tool for the chat agent.
 *
 * This tool provides structured database queries for questions
 * about blog statistics, counts, lists, and filtered data.
 * Uses safe Eloquent queries to prevent SQL injection.
 *
 * @category Tools
 */
class QueryDatabaseTool
{
    public function __construct(
        private TextToSqlService $textToSqlService
    ) {}

    /**
     * Query the database based on natural language intent.
     *
     * @param  string  $question  The user's question about blog data
     * @return string Natural language answer based on query results
     */
    public function __invoke(string $question): string
    {
        return $this->textToSqlService->answer($question);
    }

    /**
     * Query the database and return structured results.
     *
     * @param  string  $question  The user's question
     * @return array<string, mixed> Structured query results
     */
    public function query(string $question): array
    {
        $answer = $this->textToSqlService->answer($question);
        $shouldFallback = $this->textToSqlService->shouldFallback($question);

        return [
            'question' => $question,
            'answer' => $answer,
            'should_fallback' => $shouldFallback,
            'success' => $answer !== 'fallback',
        ];
    }
}
