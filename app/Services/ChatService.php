<?php

declare(strict_types=1);

namespace App\Services;

class ChatService
{
    public function __construct(
        private QuestionClassifierService $classifier,
        private StatsService $stats,
        private RAGService $rag
    ) {}

    public function answer(string $question): string
    {
        $intent = $this->classifier->classify($question);

        if ($intent === 'stats') {
            return $this->stats->answer($question);
        }

        return $this->rag->answer($question);
    }
}
