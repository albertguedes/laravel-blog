<?php

declare(strict_types=1);

namespace App\Services;

/**
 * Chat service for handling user questions and routing to appropriate agents.
 *
 * This service acts as the main entry point for the chatbot functionality,
 * coordinating between the question router and response agents (SQL or RAG).
 *
 * @category Services
 *
 * @author   Albert R. C. Guedes <albert@teko.net.br>
 *
 * @since    1.0.0
 * @see      QuestionRouterService  For intent routing logic
 * @see      SqlAgentService       For SQL-based responses
 * @see      RAGService           For content-based responses
 */
class ChatService
{
    /**
     * ChatService constructor.
     *
     * @param  QuestionRouterService  $router  Router for determining question intent
     * @param  SqlAgentService  $sqlAgent  Agent for SQL-based responses
     * @param  RAGService  $rag  Agent for RAG-based responses
     * @return void
     *
     * @since  1.0.0
     */
    public function __construct(
        private QuestionRouterService $router,
        private SqlAgentService $sqlAgent,
        private RAGService $rag
    ) {}

    /**
     * Process a user question and return an answer.
     *
     * Routes the question to either the SQL agent (for factual queries)
     * or RAG service (for content-based questions).
     *
     * @param  string  $question  The user's question in Portuguese
     * @return string The formatted answer to display to the user
     *
     * @throws \Exception When no answer can be generated
     *
     * @example
     *     $answer = $chatService->answer('quantos posts existem?');
     *     // Returns: "Este blog possui 25 posts publicados."
     *
     * @since   1.0.0
     */
    public function answer(string $question): string
    {
        $intent = $this->router->route($question);

        if ($intent === QuestionRouterService::INTENT_SQL) {
            $answer = $this->sqlAgent->answer($question);

            if (! empty($answer)) {
                return $answer;
            }
        }

        return $this->rag->answer($question);
    }
}
