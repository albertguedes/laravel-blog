<?php

declare(strict_types=1);

namespace App\Services;

class QuestionRouterService
{
    public const INTENT_SQL = 'sql';

    public const INTENT_RAG = 'rag';

    public function route(string $question): string
    {
        if ($this->isSqlQuestion($question)) {
            return self::INTENT_SQL;
        }

        return self::INTENT_RAG;
    }

    private function isSqlQuestion(string $question): bool
    {
        $question = strtolower(trim($question));

        $patterns = [
            // Count posts patterns
            '/quantos?\s+(posts?|artigos?)/i',
            '/quantidade\s+de\s+(posts?|artigos?)/i',
            '/n[uú]mero\s+de\s+(posts?|artigos?)/i',

            // Posts by author patterns
            '/posts?\s+(do|da|dos|das)\s+autor/i',
            '/posts?\s+(do|da|dos|das)\s+([a-zà-ÿ\s]+)\s+autor/i',
            '/autor\s+([a-zà-ÿ\s]+)/i',
            '/autores?\s+(ativo|inativ|c[aá]dastro)/i',
            '/autores?\s+(com\s+mais|menos|poucos)/i',

            // Posts by category patterns
            '/posts?\s+(da|do|das|dos)\s+categoria/i',
            '/posts?\s+(da|do|das|dos)\s+([a-zà-ÿ\s]+)/i',
            '/categoria\s+([a-zà-ÿ\s]+)/i',
            '/categorias?\s+(com\s+mais|menos|poucos)/i',

            // Posts by tag patterns
            '/posts?\s+(com\s+)?tag/i',
            '/tag\s+([a-zà-ÿ\s]+)/i',

            // List/show posts patterns
            '/listar\s+posts?/i',
            '/mostrar\s+posts?/i',
            '/exibir\s+posts?/i',

            // Recent/popular posts patterns
            '/posts?\s+(recente|novo|mais\s+novo)/i',
            '/posts?\s+(antigo|velho|mais\s+velho)/i',
            '/posts?\s+(popular|mais\s+visto|mais\s+visualizado)/i',

            // Author statistics
            '/estat[íi]stica\s+(do|da)\s+autor/i',
            '/autor\s+([a-zà-ÿ\s]+)\s+(posts?|quantos)/i',

            // Category statistics
            '/estat[íi]stica\s+(da|do)\s+categoria/i',
            '/categoria\s+([a-zà-ÿ\s]+)\s+(posts?|quantos)/i',

            // Generic stats patterns
            '/estat[íi]stica/i',
            '/resumo\s+(do|da)/i',

            // Order by post count
            '/mais\s+(posts?|populares?|visualizados?)/i',
            '/menos\s+(posts?|populares?)/i',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $question)) {
                return true;
            }
        }

        return false;
    }
}
