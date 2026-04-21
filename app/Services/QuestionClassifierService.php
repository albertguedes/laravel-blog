<?php

declare(strict_types=1);

namespace App\Services;

/**
 * Service for classifying user questions to determine the appropriate response route.
 *
 * @author Albert
 *
 * @since 1.0.0
 */
class QuestionClassifierService
{
    /**
     * Classify a question to determine its type.
     *
     * @param  string  $question  The question to classify
     * @return string The classification ('stats' or 'rag')
     */
    public function classify(string $question): string
    {
        $q = mb_strtolower($question);

        if (str_contains($q, 'quantos') ||
            str_contains($q, 'quantidade') ||
            str_contains($q, 'número')) {
            return 'stats';
        }

        if (str_contains($q, 'maior') ||
            str_contains($q, 'menor')) {
            return 'stats';
        }

        if (str_contains($q, 'autor') ||
            str_contains($q, 'ativo') ||
            str_contains($q, 'inativo')) {
            return 'stats';
        }

        return 'rag';
    }
}
