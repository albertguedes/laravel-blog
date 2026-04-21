<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Post;
use App\Models\User;

/**
 * Service for answering statistical questions about the blog.
 *
 * @author Albert
 *
 * @since 1.0.0
 */
class StatsService
{
    /**
     * Answer a statistical question about the blog.
     *
     * @param  string  $question  The question to answer
     * @return string The answer
     */
    public function answer(string $question): string
    {
        $q = mb_strtolower($question);

        if (str_contains($q, 'quantos') && str_contains($q, 'post')) {
            return 'O blog possui '.Post::count().' posts.';
        }

        if (str_contains($q, 'maior post')) {
            $post = Post::orderByRaw('LENGTH(content) DESC')->first();

            return "O maior post é '{$post->title}'.";
        }

        if (str_contains($q, 'autor') && str_contains($q, 'inativo')) {
            $count = User::where('is_active', false)
                ->whereHas('posts')
                ->count();

            return "Existem {$count} autores inativos com posts publicados.";
        }

        return 'Não consegui responder essa pergunta com dados do sistema.';
    }
}
