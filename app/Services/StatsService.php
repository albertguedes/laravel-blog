<?php declare(strict_types=1);

namespace App\Services;

use App\Models\Post;
use App\Models\Author;

class StatsService
{
    public function answer(string $question): string
    {
        $q = mb_strtolower($question);

        if (str_contains($q, 'quantos') && str_contains($q, 'post')) {
            return 'O blog possui ' . Post::count() . ' posts.';
        }

        if (str_contains($q, 'maior post')) {
            $post = Post::orderByRaw('LENGTH(content) DESC')->first();
            return "O maior post é '{$post->title}'.";
        }

        if (str_contains($q, 'autor') && str_contains($q, 'inativo')) {
            $count = Author::where('is_active', false)
                ->whereHas('posts')
                ->count();

            return "Existem {$count} autores inativos com posts publicados.";
        }

        return 'Não consegui responder essa pergunta com dados do sistema.';
    }
}
