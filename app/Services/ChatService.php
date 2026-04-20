<?php

declare(strict_types=1);

namespace App\Services;

class ChatService
{
    public function __construct(
        private QuestionRouterService $router,
        private SqlAgentService $sqlAgent,
        private RAGService $rag
    ) {}

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
