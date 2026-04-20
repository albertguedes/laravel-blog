<?php

declare(strict_types=1);

namespace App\Services;

use App\Agents\ChatAgent;

/**
 * Routes user questions to the chat agent.
 *
 * This service acts as a facade that delegates questions to the ChatAgent,
 * which decides whether to use the page links tool, database query tool,
 * or the RAG search tool based on the question content.
 *
 * @category Services
 *
 * @see ChatAgent For tool routing logic
 * @see ChatController For the HTTP endpoint
 */
class ChatService
{
    /**
     * Creates a new ChatService instance.
     */
    public function __construct(
        private ChatAgent $agent,
        private MarkdownService $markdownService
    ) {}

    /**
     * Returns an answer to the given question.
     *
     * Delegates to the ChatAgent which decides whether to use
     * the page links tool (for page links), database query tool
     * (for stats/counts/lists), or the RAG search tool (for knowledge questions).
     * The answer is then parsed as markdown.
     *
     * @param  string  $question  The question to answer
     * @return string The answer to the question
     */
    public function answer(string $question): string
    {
        $rawAnswer = $this->agent->answer($question);

        return $this->markdownService->parse($rawAnswer);
    }
}
