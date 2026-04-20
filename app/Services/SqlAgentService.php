<?php

declare(strict_types=1);

namespace App\Services;

class SqlAgentService
{
    private BlogQueryService $queryService;

    public function __construct(BlogQueryService $queryService)
    {
        $this->queryService = $queryService;
    }

    public function answer(string $question): string
    {
        $question = strtolower(trim($question));

        // Count posts (generic)
        if (preg_match('/quantos?\s+posts?/i', $question)) {
            return $this->handlePostCount($question);
        }

        // Posts by author
        if (preg_match('/posts?\s+(do|da|dos|das)\s+autor\s+(.+)/i', $question, $matches)) {
            return $this->handlePostsByAuthor($matches[2]);
        }

        if (preg_match('/posts?\s+(do|da)\s+autor/i', $question)) {
            return $this->handlePostsByAuthor($question);
        }

        // Posts by category
        if (preg_match('/posts?\s+(da|do|das|dos)\s+(?:categoria\s+)?(.+)/i', $question, $matches)) {
            return $this->handlePostsByCategory($matches[2]);
        }

        // Posts by tag
        if (preg_match('/posts?\s+(com\s+)?(?:tag\s+)?(.+)/i', $question, $matches)) {
            return $this->handlePostsByTag($matches[2]);
        }

        // Recent posts
        if (preg_match('/posts?\s+(recente|novo|mais\s+novo)/i', $question)) {
            return $this->handleRecentPosts($question);
        }

        // Authors active/inactive
        if (preg_match('/autores?\s+(ativo|inativ|cadastro)/i', $question)) {
            return $this->handleAuthorStatus($question);
        }

        // Authors with most posts
        if (preg_match('/autores?\s+(com\s+mais|menos|poucos)/i', $question)) {
            return $this->handleAuthorsOrderedByPosts($question);
        }

        // Categories with most posts
        if (preg_match('/categorias?\s+(com\s+mais|menos|poucos)/i', $question)) {
            return $this->handleCategoriesOrderedByPosts($question);
        }

        // List posts
        if (preg_match('/(?:listar|mostrar|exibir)\s+posts?/i', $question)) {
            return $this->handleListPosts($question);
        }

        // Generic - try to handle as author search
        if (preg_match('/autor\s+(.+)/i', $question, $matches)) {
            return $this->handlePostsByAuthor($matches[1]);
        }

        // Generic - try to handle as category search
        if (preg_match('/categoria\s+(.+)/i', $question, $matches)) {
            return $this->handlePostsByCategory($matches[1]);
        }

        // Fallback - return empty to trigger RAG
        return '';
    }

    private function handlePostCount(string $question): string
    {
        $filters = [];

        if (preg_match('/publicad/i', $question)) {
            $filters['published'] = true;
        } elseif (preg_match('/rascunho|draft/i', $question)) {
            $filters['published'] = false;
        }

        $count = $this->queryService->getPostCount($filters);

        if ($count === 0) {
            return 'Não existem posts publicados no momento.';
        }

        $publishedText = isset($filters['published']) ? ($filters['published'] ? 'publicados' : 'em rascunho') : '';
        $publishedText = $publishedText ? " {$publishedText}" : ' publicados';

        return "Este blog possui {$count} posts{$publishedText}.";
    }

    private function handlePostsByAuthor(string $authorName): string
    {
        $authorName = trim($authorName);
        $author = $this->queryService->findAuthorByName($authorName);

        if (! $author) {
            return "Não encontrei nenhum autor com o nome '$authorName'.";
        }

        $posts = $this->queryService->getPostsByAuthor($author->id, 10);
        $authorNameDisplay = $author->profile->name ?? 'Autor Desconhecido';

        if ($posts->isEmpty()) {
            return "O autor '$authorNameDisplay' não possui posts publicados.";
        }

        $count = $posts->count();
        $output = "O autor '$authorNameDisplay' possui {$count} posts publicados:\n\n";

        foreach ($posts as $post) {
            $title = mb_substr($post->title, 0, 60);
            $output .= "• {$title}";
            if (mb_strlen($post->title) > 60) {
                $output .= '...';
            }
            $output .= "\n";
        }

        return $output;
    }

    private function handlePostsByCategory(string $categoryName): string
    {
        $categoryName = trim($categoryName);
        $category = $this->queryService->findCategoryByName($categoryName);

        if (! $category) {
            return "Não encontrei nenhuma categoria com o nome '$categoryName'.";
        }

        $posts = $this->queryService->getPostsByCategory($category->id, 10);

        if ($posts->isEmpty()) {
            return "A categoria '{$category->title}' não possui posts publicados.";
        }

        $count = $posts->count();
        $output = "A categoria '{$category->title}' possui {$count} posts:\n\n";

        foreach ($posts as $post) {
            $title = mb_substr($post->title, 0, 60);
            $output .= "• {$title}";
            if (mb_strlen($post->title) > 60) {
                $output .= '...';
            }
            $output .= "\n";
        }

        return $output;
    }

    private function handlePostsByTag(string $tagName): string
    {
        $tagName = trim($tagName);
        $tag = $this->queryService->findTagByName($tagName);

        if (! $tag) {
            return "Não encontrei nenhuma tag com o nome '$tagName'.";
        }

        $posts = $this->queryService->getPostsByTag($tag->id, 10);

        if ($posts->isEmpty()) {
            return "A tag '{$tag->title}' não possui posts.";
        }

        $count = $posts->count();
        $output = "A tag '{$tag->title}' aparece em {$count} posts:\n\n";

        foreach ($posts as $post) {
            $title = mb_substr($post->title, 0, 60);
            $output .= "• {$title}";
            if (mb_strlen($post->title) > 60) {
                $output .= '...';
            }
            $output .= "\n";
        }

        return $output;
    }

    private function handleRecentPosts(string $question): string
    {
        $limit = 5;

        if (preg_match('/(\d+)\s+(recente|novo)/i', $question, $matches)) {
            $limit = (int) $matches[1];
        }

        $posts = $this->queryService->getRecentPosts($limit);

        if ($posts->isEmpty()) {
            return 'Não existem posts recentes.';
        }

        $output = "Aqui estão os {$limit} posts mais recentes:\n\n";

        foreach ($posts as $post) {
            $title = mb_substr($post->title, 0, 60);
            $date = $post->updated_at->format('d/m/Y');
            $output .= "• {$title}";
            if (mb_strlen($post->title) > 60) {
                $output .= '...';
            }
            $output .= " ({$date})\n";
        }

        return $output;
    }

    private function handleAuthorStatus(string $question): string
    {
        $isActive = ! preg_match('/inativ/i', $question);

        if ($isActive) {
            $authors = $this->queryService->getActiveAuthors(20);
            $output = "Autores ativos com posts publicados:\n\n";
        } else {
            $authors = $this->queryService->getInactiveAuthors(20);
            $output = "Autores inativos com posts publicados:\n\n";
        }

        if ($authors->isEmpty()) {
            return $isActive
                ? 'Não existem autores ativos com posts publicados.'
                : 'Não existem autores inativos com posts publicados.';
        }

        foreach ($authors as $author) {
            $name = $author->profile->name ?? 'Autor Desconhecido';
            $postCount = $author->posts->count();
            $output .= "• {$name} ({$postCount} posts)\n";
        }

        return $output;
    }

    private function handleAuthorsOrderedByPosts(string $question): string
    {
        $limit = str_contains($question, 'menos') || str_contains($question, 'poucos')
            ? 5
            : 10;

        $authors = $this->queryService->getAuthorsOrderedByPostCount($limit);

        if ($authors->isEmpty()) {
            return 'Não existem autores com posts.';
        }

        $isDesc = ! str_contains($question, 'menos') && ! str_contains($question, 'poucos');
        $output = $isDesc
            ? "Autores com mais posts:\n\n"
            : "Autores com menos posts:\n\n";

        foreach ($authors as $author) {
            $name = $author->profile->name ?? 'Autor Desconhecido';
            $postCount = $author->posts_count;
            $output .= "• {$name}: {$postCount} posts\n";
        }

        return $output;
    }

    private function handleCategoriesOrderedByPosts(string $question): string
    {
        $limit = str_contains($question, 'menos') || str_contains($question, 'poucos')
            ? 5
            : 10;

        $categories = $this->queryService->getCategoriesOrderedByPostCount($limit);

        if ($categories->isEmpty()) {
            return 'Não existem categorias com posts.';
        }

        $isDesc = ! str_contains($question, 'menos') && ! str_contains($question, 'poucos');
        $output = $isDesc
            ? "Categorias com mais posts:\n\n"
            : "Categorias com menos posts:\n\n";

        foreach ($categories as $category) {
            $postCount = $category->posts_count;
            $output .= "• {$category->title}: {$postCount} posts\n";
        }

        return $output;
    }

    private function handleListPosts(string $question): string
    {
        $limit = 10;

        if (preg_match('/(\d+)/', $question, $matches)) {
            $limit = min((int) $matches[1], 20);
        }

        $posts = $this->queryService->getRecentPosts($limit);

        if ($posts->isEmpty()) {
            return 'Não existem posts para listar.';
        }

        $output = "Lista de {$limit} posts:\n\n";

        foreach ($posts as $post) {
            $title = mb_substr($post->title, 0, 60);
            $authorName = $post->author->profile->name ?? 'Autor Desconhecido';
            $output .= "• {$title}";
            if (mb_strlen($post->title) > 60) {
                $output .= '...';
            }
            $output .= " - por {$authorName}\n";
        }

        return $output;
    }
}
