<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

/**
 * Converts natural language questions to safe Eloquent queries.
 *
 * This service analyzes user questions about blog statistics and data,
 * generates appropriate Eloquent queries, and executes them safely.
 * Only SELECT queries are allowed, and only on approved tables/columns.
 *
 * @category Services
 */
class TextToSqlService
{
    /**
     * Allowed tables and their safe columns for querying.
     */
    private const ALLOWED_TABLES = [
        'posts' => ['id', 'title', 'slug', 'content', 'excerpt', 'status', 'published_at', 'created_at', 'updated_at', 'user_id', 'category_id'],
        'users' => ['id', 'name', 'email', 'is_active', 'created_at'],
        'categories' => ['id', 'title', 'slug', 'description', 'is_active'],
        'tags' => ['id', 'title', 'slug', 'is_active'],
    ];

    /**
     * Answer a question by generating and executing an Eloquent query.
     *
     * @param  string  $question  The user's question in natural language
     * @return string Natural language answer based on query results
     */
    public function answer(string $question): string
    {
        $intent = $this->classifyIntent($question);

        $result = match ($intent['type']) {
            'count' => $this->handleCount($intent),
            'list' => $this->handleList($intent),
            'latest' => $this->handleLatest($intent),
            'filter' => $this->handleFilter($intent),
            'aggregate' => $this->handleAggregate($intent),
            'exists' => $this->handleExists($intent),
            default => $this->generateFallbackResponse($intent),
        };

        return $result;
    }

    /**
     * Classify the intent of the question.
     *
     * @param  string|array  $question  The question to classify
     * @return array<string, mixed> The intent classification
     */
    private function classifyIntent(string|array $question): array
    {
        $questionLower = is_array($question) ? ($question['question'] ?? $question['original'] ?? '') : $question;
        $questionLower = mb_strtolower($questionLower);

        if (preg_match('/\b(quantos?|how many|quantidade|number)\b/', $questionLower)) {
            return $this->detectCountType($questionLower);
        }

        if (preg_match('/\b(listar|liste|list|mostrar|show|exibir)\b/', $questionLower)) {
            return $this->detectListType($questionLower);
        }

        if (preg_match('/\b(ultimo|último|last|recente|mais novo)\b/', $questionLower)) {
            return ['type' => 'latest', 'table' => $this->detectTable($questionLower), 'question' => $question];
        }

        if (preg_match('/\b(sobre|about|content|topics|temas)\b/', $questionLower)) {
            return ['type' => 'filter', 'table' => $this->detectTable($questionLower), 'question' => $question];
        }

        if (preg_match('/\b(melhor|best|maior|mais grande|biggest)\b/', $questionLower)) {
            return ['type' => 'aggregate', 'aggregate' => 'max', 'table' => $this->detectTable($questionLower), 'question' => $question];
        }

        if (preg_match('/\b(existe?|exists?|ha |há)\b/', $questionLower)) {
            return ['type' => 'exists', 'table' => $this->detectTable($questionLower), 'question' => $question];
        }

        return ['type' => 'unknown', 'question' => $question];
    }

    /**
     * Detect the specific type of count query.
     */
    private function detectCountType(string $question): array
    {
        if (preg_match('/autor|authors?|user/i', $question)) {
            if (preg_match('/inativ|inactive/i', $question)) {
                return ['type' => 'count', 'table' => 'users', 'filter' => 'inactive', 'question' => $question];
            }
            if (preg_match('/ativ|active/i', $question)) {
                return ['type' => 'count', 'table' => 'users', 'filter' => 'active', 'question' => $question];
            }

            return ['type' => 'count', 'table' => 'users', 'question' => $question];
        }

        if (preg_match('/categor|cat/i', $question)) {
            return ['type' => 'count', 'table' => 'categories', 'question' => $question];
        }

        if (preg_match('/tag/i', $question)) {
            return ['type' => 'count', 'table' => 'tags', 'question' => $question];
        }

        if (preg_match('/post|artigo|article/i', $question)) {
            if (preg_match('/publicad|published/i', $question)) {
                return ['type' => 'count', 'table' => 'posts', 'filter' => 'published', 'question' => $question];
            }
            if (preg_match('/rascunh|draft/i', $question)) {
                return ['type' => 'count', 'table' => 'posts', 'filter' => 'draft', 'question' => $question];
            }

            return ['type' => 'count', 'table' => 'posts', 'question' => $question];
        }

        return ['type' => 'count', 'table' => 'posts', 'question' => $question];
    }

    /**
     * Detect the specific type of list query.
     */
    private function detectListType(string $question): array
    {
        if (preg_match('/autor|authors?|user/i', $question)) {
            return ['type' => 'list', 'table' => 'users', 'question' => $question];
        }

        if (preg_match('/categor|cat/i', $question)) {
            return ['type' => 'list', 'table' => 'categories', 'question' => $question];
        }

        if (preg_match('/tag/i', $question)) {
            return ['type' => 'list', 'table' => 'tags', 'question' => $question];
        }

        return ['type' => 'list', 'table' => 'posts', 'question' => $question];
    }

    /**
     * Detect which table is being queried.
     */
    private function detectTable(string $question): string
    {
        if (preg_match('/autor|author|user/i', $question)) {
            return 'users';
        }
        if (preg_match('/categor|cat/i', $question)) {
            return 'categories';
        }
        if (preg_match('/tag/i', $question)) {
            return 'tags';
        }

        return 'posts';
    }

    /**
     * Handle count queries.
     */
    private function handleCount(array $intent): string
    {
        $table = $intent['table'];
        $filter = $intent['filter'] ?? null;

        $query = match ($table) {
            'posts' => $this->countPosts($filter),
            'users' => $this->countUsers($filter),
            'categories' => $this->countCategories(),
            'tags' => $this->countTags(),
            default => 'Não consigo responder essa pergunta.',
        };

        return $query;
    }

    /**
     * Handle list queries.
     */
    private function handleList(array $intent): string
    {
        $table = $intent['table'];
        $question = $intent['question'];

        return match ($table) {
            'posts' => $this->listPosts($question),
            'users' => $this->listUsers(),
            'categories' => $this->listCategories(),
            'tags' => $this->listTags(),
            default => 'fallback',
        };
    }

    /**
     * Handle latest/fresh queries.
     */
    private function handleLatest(array $intent): string
    {
        $table = $intent['table'];

        return match ($table) {
            'posts' => $this->latestPost(),
            default => 'fallback',
        };
    }

    /**
     * Handle filter queries.
     */
    private function handleFilter(array $intent): string
    {
        $table = $intent['table'];
        $question = $intent['question'];

        return match ($table) {
            'posts' => $this->filterPosts($question),
            default => 'fallback',
        };
    }

    /**
     * Handle aggregate queries (max, min, etc.).
     */
    private function handleAggregate(array $intent): string
    {
        $table = $intent['table'];
        $question = $intent['question'];

        return match ($table) {
            'posts' => $this->aggregatePosts($question),
            default => 'fallback',
        };
    }

    /**
     * Handle exists queries.
     */
    private function handleExists(array $intent): string
    {
        $table = $intent['table'];
        $question = $intent['question'];

        return match ($table) {
            'posts' => $this->existsPost($question),
            default => 'fallback',
        };
    }

    /**
     * Count posts with optional filter.
     */
    private function countPosts(?string $filter = null): string
    {
        $query = Post::query()->whereHas('user', fn ($q) => $q->where('is_active', true));

        if ($filter === 'published') {
            $count = $query->where('status', 'published')->count();

            return "O blog possui {$count} posts publicados.";
        }

        if ($filter === 'draft') {
            $count = $query->where('status', 'draft')->count();

            return "O blog possui {$count} posts em rascunho.";
        }

        $count = $query->count();

        return "O blog possui {$count} posts no total.";
    }

    /**
     * Count users with optional filter.
     */
    private function countUsers(?string $filter = null): string
    {
        $query = User::query();

        if ($filter === 'inactive') {
            $count = $query->where('is_active', false)->count();

            return "Existem {$count} autores inativos.";
        }

        if ($filter === 'active') {
            $count = $query->where('is_active', true)->count();

            return "Existem {$count} autores ativos.";
        }

        $count = $query->count();

        return "O blog possui {$count} autores.";
    }

    /**
     * Count categories.
     */
    private function countCategories(): string
    {
        $count = Category::where('is_active', true)->count();

        return "Existen {$count} categorias ativas.";
    }

    /**
     * Count tags.
     */
    private function countTags(): string
    {
        $count = Tag::where('is_active', true)->count();

        return "Existen {$count} tags.";
    }

    /**
     * List posts based on question.
     */
    private function listPosts(string $question): string
    {
        $baseQuery = Post::where('status', 'published')
            ->whereHas('user', fn ($q) => $q->where('is_active', true));

        if (preg_match('/\b(\d{4})\b/', $question, $matches)) {
            $year = $matches[1];
            $posts = (clone $baseQuery)
                ->whereYear('published_at', $year)
                ->orderBy('published_at', 'desc')
                ->limit(10)
                ->get();

            if ($posts->isEmpty()) {
                return "Não encontrei posts de {$year}.";
            }

            $list = $posts->pluck('title')->implode(', ');

            return "Posts de {$year}: {$list}";
        }

        if (preg_match('/\b(mais recente|recent|last)\b/i', $question)) {
            $posts = (clone $baseQuery)
                ->orderBy('published_at', 'desc')
                ->limit(5)
                ->get();

            $list = $posts->pluck('title')->implode(', ');

            return "Posts mais recentes: {$list}";
        }

        $posts = (clone $baseQuery)
            ->orderBy('published_at', 'desc')
            ->limit(10)
            ->get();

        $list = $posts->pluck('title')->implode(', ');

        return "Posts: {$list}";
    }

    /**
     * List users/authors.
     */
    private function listUsers(): string
    {
        $users = User::where('is_active', true)
            ->orderBy('name')
            ->limit(10)
            ->get();

        $list = $users->pluck('name')->implode(', ');

        return "Autores: {$list}";
    }

    /**
     * List categories.
     */
    private function listCategories(): string
    {
        $categories = Category::where('is_active', true)
            ->orderBy('title')
            ->limit(10)
            ->get();

        $list = $categories->pluck('title')->implode(', ');

        return "Categorias: {$list}";
    }

    /**
     * List tags.
     */
    private function listTags(): string
    {
        $tags = Tag::where('is_active', true)
            ->orderBy('title')
            ->limit(20)
            ->get();

        $list = $tags->pluck('title')->implode(', ');

        return "Tags: {$list}";
    }

    /**
     * Get the latest post.
     */
    private function latestPost(): string
    {
        $post = Post::where('status', 'published')
            ->whereHas('user', fn ($q) => $q->where('is_active', true))
            ->orderBy('published_at', 'desc')
            ->first();

        if (! $post) {
            return 'Não encontrei posts publicados.';
        }

        $date = $post->published_at->format('d/m/Y');

        return "O post mais recente é '{$post->title}' ({$date}).";
    }

    /**
     * Filter posts by topic/tag.
     */
    private function filterPosts(string $question): string
    {
        if (preg_match('/\btag\s*:?\s*(\w+)/i', $question, $matches)) {
            $tagSlug = $matches[1];
            $tag = Tag::where('is_active', true)->where('slug', 'like', "%{$tagSlug}%")->first();

            if (! $tag) {
                return "Não encontrei a tag '{$tagSlug}'.";
            }

            $posts = Post::where('status', 'published')
                ->whereHas('user', fn ($q) => $q->where('is_active', true))
                ->whereHas('tags', fn ($q) => $q->where('tags.id', $tag->id))
                ->orderBy('published_at', 'desc')
                ->limit(10)
                ->get();

            if ($posts->isEmpty()) {
                return "Não encontrei posts com a tag '{$tag->title}'.";
            }

            $list = $posts->pluck('title')->implode(', ');

            return "Posts sobre '{$tag->title}': {$list}";
        }

        if (preg_match('/\bcategori[ae]\s*:?\s*(\w+)/i', $question, $matches)) {
            $catSlug = $matches[1];
            $category = Category::where('is_active', true)->where('slug', 'like', "%{$catSlug}%")->first();

            if (! $category) {
                return "Não encontrei a categoria '{$catSlug}'.";
            }

            $posts = Post::where('status', 'published')
                ->whereHas('user', fn ($q) => $q->where('is_active', true))
                ->where('category_id', $category->id)
                ->orderBy('published_at', 'desc')
                ->limit(10)
                ->get();

            if ($posts->isEmpty()) {
                return "Não encontrei posts na categoria '{$category->title}'.";
            }

            $list = $posts->pluck('title')->implode(', ');

            return "Posts na categoria '{$category->title}': {$list}";
        }

        return 'fallback';
    }

    /**
     * Aggregate posts (best, biggest, etc.).
     */
    private function aggregatePosts(string $question): string
    {
        $baseQuery = Post::where('status', 'published')
            ->whereHas('user', fn ($q) => $q->where('is_active', true));

        if (preg_match('/\b(maior|melhor|biggest|best|longest)\b.*\bpost/i', $question)) {
            $post = (clone $baseQuery)
                ->orderByRaw('LENGTH(content) DESC')
                ->first();

            if (! $post) {
                return 'Não encontrei posts.';
            }

            $length = strlen(strip_tags($post->content));

            return "O maior post é '{$post->title}' ({$length} caracteres).";
        }

        if (preg_match('/\bpost.*\b(mais antigo|oldest)\b/i', $question)) {
            $post = (clone $baseQuery)
                ->orderBy('published_at', 'asc')
                ->first();

            if (! $post) {
                return 'Não encontrei posts.';
            }

            $date = $post->published_at->format('d/m/Y');

            return "O post mais antigo é '{$post->title}' ({$date}).";
        }

        return 'fallback';
    }

    /**
     * Check if something exists.
     */
    private function existsPost(string $question): string
    {
        preg_match('/\bsobre\s*(.+?)\s*\?$/i', $question, $matches);

        if (! empty($matches[1])) {
            $search = $matches[1];
            $exists = Post::where('status', 'published')
                ->whereHas('user', fn ($q) => $q->where('is_active', true))
                ->where(fn ($q) => $q->where('title', 'like', "%{$search}%")->orWhere('content', 'like', "%{$search}%"))
                ->exists();

            if ($exists) {
                return "Sim, existe posts sobre '{$search}'.";
            }

            return "Não encontrei posts sobre '{$search}'.";
        }

        return 'fallback';
    }

    /**
     * Generate fallback response when query cannot be determined.
     */
    private function generateFallbackResponse(array $intent): string
    {
        return 'fallback';
    }

    /**
     * Check if the question should fallback to RAG.
     */
    public function shouldFallback(string $question): bool
    {
        $fallbackKeywords = ['sobre', 'about', 'oq ', 'o que ', 'quem ', 'como ', 'por que ', 'why', 'what', 'who', 'how', 'fala', 'diz', 'explica'];

        foreach ($fallbackKeywords as $keyword) {
            if (mb_stripos($question, $keyword) !== false) {
                return true;
            }
        }

        return false;
    }
}
