<?php

declare(strict_types=1);

namespace App\Tools;

use App\Services\LinkHelperService;

class PageLinksTool
{
    private const MAX_INDIVIDUAL_LINKS = 10;

    public function __construct(
        private LinkHelperService $linkHelper
    ) {}

    public function __invoke(string $query): string
    {
        $result = $this->query($query);

        if ($result['success']) {
            return $result['answer'];
        }

        return 'fallback';
    }

    public function query(string $question): array
    {
        $questionLower = mb_strtolower($question);

        $intent = $this->detectIntent($questionLower);

        if (! $intent) {
            return ['success' => false, 'answer' => 'fallback', 'should_fallback' => true];
        }

        $answer = match ($intent['type']) {
            'static_page' => $this->handleStaticPage($intent['page']),
            'categories' => $this->handleCategories($intent),
            'tags' => $this->handleTags($intent),
            'authors' => $this->handleAuthors($intent),
            'recent_posts' => $this->handleRecentPosts($intent),
            'search_posts' => $this->handleSearchPosts($question),
            default => 'fallback',
        };

        if ($answer === 'fallback') {
            return ['success' => false, 'answer' => 'fallback', 'should_fallback' => true];
        }

        return ['success' => true, 'answer' => $answer, 'should_fallback' => false];
    }

    private function detectIntent(string $question): ?array
    {
        if ($this->isStaticPageQuery($question)) {
            return ['type' => 'static_page', 'page' => $this->extractStaticPage($question)];
        }

        if ($this->isCategoriesQuery($question)) {
            return ['type' => 'categories', 'slug' => $this->extractSlug($question, 'categor')];
        }

        if ($this->isTagsQuery($question)) {
            return ['type' => 'tags', 'slug' => $this->extractSlug($question, 'tag')];
        }

        if ($this->isAuthorsQuery($question)) {
            return ['type' => 'authors', 'slug' => $this->extractSlug($question, 'author')];
        }

        if ($this->isRecentPostsQuery($question)) {
            return ['type' => 'recent_posts'];
        }

        if ($this->isSearchPostsQuery($question)) {
            return ['type' => 'search_posts', 'query' => $this->extractSearchQuery($question)];
        }

        return null;
    }

    private function isStaticPageQuery(string $question): bool
    {
        if (preg_match('/\b(posts?|articles?)\b.*\b(about|on|sobre)\b/i', $question)) {
            return false;
        }

        $patterns = [
            '\b(contact|about|home|archive|chat|search)\b',
            'link (para|do)? ?(contact|about|home|archive)',
            'how (do |can )?(i |I )?(reach|contact|find|get to|access)',
            'where (is|are)? ?(contact|about|home|archive|page)',
            'p(a|á)gina (de |do )?(contato|sobre|home|arquivo|chat)',
            'me dá o link',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match('/'.$pattern.'/i', $question)) {
                return true;
            }
        }

        return false;
    }

    private function extractStaticPage(string $question): string
    {
        $pages = ['contact', 'about', 'home', 'archive', 'chat', 'search'];

        foreach ($pages as $page) {
            if (preg_match('/\b'.$page.'\b/i', $question)) {
                return $page;
            }
        }

        if (preg_match('/(contact|contato)/i', $question)) {
            return 'contact';
        }
        if (preg_match('/(about|sobre)/i', $question)) {
            return 'about';
        }
        if (preg_match('/(home|ínicio|início)/i', $question)) {
            return 'home';
        }
        if (preg_match('/(archive|arquivo)/i', $question)) {
            return 'archive';
        }
        if (preg_match('/(chat|bate-papo)/i', $question)) {
            return 'chat';
        }

        return 'home';
    }

    private function isCategoriesQuery(string $question): bool
    {
        return (bool) preg_match('/\b(categor|category|categories)\b/i', $question);
    }

    private function isTagsQuery(string $question): bool
    {
        return (bool) preg_match('/\b(tag|etiqueta|tags?)\b/i', $question);
    }

    private function isAuthorsQuery(string $question): bool
    {
        return (bool) preg_match('/\b(autor|author|authors?)\b/i', $question);
    }

    private function isRecentPostsQuery(string $question): bool
    {
        $patterns = [
            '\b(latest|recent|novos|recentes|recenti)\b.*\b(posts?|articles?)\b',
            '\b(posts?|articles?)\b.*\b(latest|recent|novos|recentes)\b',
            '\b(newest)\b',
            '\b(primeiro|último|ultimo)\b.*\bpost',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match('/'.$pattern.'/i', $question)) {
                return true;
            }
        }

        return false;
    }

    private function isSearchPostsQuery(string $question): bool
    {
        $patterns = [
            '\bposts?\b.*\b(about|on|sobre)\b',
            '\bsearch\b.*\b(posts?|articles?)\b',
            '\blinks?\b.*\b(posts?|articles?)\b',
            '\blist\b.*\b(posts?|articles?)\b',
            '\bshow\b.*\b(posts?|articles?)\b',
            '\bposts?\b.*\b(topic|subject|tema)\b',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match('/'.$pattern.'/i', $question)) {
                return true;
            }
        }

        return false;
    }

    private function extractSlug(string $question, string $type): ?string
    {
        if ($type === 'categor') {
            if (preg_match('/categor[yi][ae]?\s*:\s*(\w+)/i', $question, $matches)) {
                return $matches[1];
            }
            if (preg_match('/\bcategor[yi][ae]?\s+(de |do )?(\w+)/i', $question, $matches)) {
                return $matches[2];
            }
        }

        if ($type === 'tag') {
            if (preg_match('/tag\s*:\s*(\w+)/i', $question, $matches)) {
                return $matches[1];
            }
            if (preg_match('/\btag\s+(de |do )?(\w+)/i', $question, $matches)) {
                return $matches[2];
            }
        }

        if ($type === 'author') {
            if (preg_match('/author\s*:\s*(\w+)/i', $question, $matches)) {
                return $matches[1];
            }
            if (preg_match('/\bauthor\s+(de |do )?(\w+)/i', $question, $matches)) {
                return $matches[2];
            }
        }

        return null;
    }

    private function extractSearchQuery(string $question): ?string
    {
        $patterns = [
            '/(?:post|posts|article|articles)\s+(?:about|on|sobre)\s+(.+?)(?:\?|$)/i',
            '/(?:show|list)\s+(?:me\s+)?(?:the\s+)?(?:post|posts|article|articles)\s+(?:about|on|sobre)?\s*(.+?)(?:\?|$)/i',
            '/links?\s+(?:to\s+)?(?:post|posts|article|articles)?\s*(?:about|on|sobre)?\s*(.+?)(?:\?|$)/i',
            '/search\s+(?:for\s+)?(.+?)(?:\?|$)/i',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $question, $matches)) {
                $query = trim($matches[1]);

                if (strlen($query) >= 2) {
                    return $query;
                }
            }
        }

        return null;
    }

    private function handleStaticPage(string $page): string
    {
        $link = $this->linkHelper->getPageLink($page);

        if (empty($link)) {
            return 'fallback';
        }

        $titles = [
            'contact' => 'Contact page',
            'about' => 'About page',
            'home' => 'Home page',
            'archive' => 'Archive page',
            'chat' => 'Chat page',
            'search' => 'Search page',
        ];

        $prefix = $titles[$page] ?? 'Here is the page';

        return "{$prefix}: {$link}";
    }

    private function handleCategories(array $intent): string
    {
        $slug = $intent['slug'] ?? null;
        $links = $this->linkHelper->getCategoryLinks($slug);

        if (empty($links)) {
            if ($slug) {
                return "I couldn't find a category matching '{$slug}'.";
            }

            return 'fallback';
        }

        if (count($links) === 1) {
            $link = $this->linkHelper->formatLinks($links);

            return "Category: {$link}";
        }

        $formatted = $this->linkHelper->formatLinks($links);

        return "Categories: {$formatted}";
    }

    private function handleTags(array $intent): string
    {
        $slug = $intent['slug'] ?? null;
        $links = $this->linkHelper->getTagLinks($slug);

        if (empty($links)) {
            if ($slug) {
                return "I couldn't find a tag matching '{$slug}'.";
            }

            return 'fallback';
        }

        if (count($links) === 1) {
            $link = $this->linkHelper->formatLinks($links);

            return "Tag: {$link}";
        }

        $formatted = $this->linkHelper->formatLinks($links);

        return "Tags: {$formatted}";
    }

    private function handleAuthors(array $intent): string
    {
        $slug = $intent['slug'] ?? null;
        $links = $this->linkHelper->getAuthorLinks($slug);

        if (empty($links)) {
            if ($slug) {
                return "I couldn't find an author matching '{$slug}'.";
            }

            return 'fallback';
        }

        if (count($links) === 1) {
            $link = $this->linkHelper->formatLinks($links);

            return "Author: {$link}";
        }

        $formatted = $this->linkHelper->formatLinks($links);

        return "Authors: {$formatted}";
    }

    private function handleRecentPosts(array $intent): string
    {
        $links = $this->linkHelper->getRecentPosts(5);

        if (empty($links)) {
            return 'No recent posts found.';
        }

        $formatted = $this->linkHelper->formatLinks($links);

        return "Latest posts: {$formatted}";
    }

    private function handleSearchPosts(string $question): string
    {
        $query = $this->extractSearchQuery($question);

        if (! $query) {
            return 'fallback';
        }

        $links = $this->linkHelper->searchPosts($query);
        $count = count($links);

        if ($count === 0) {
            $totalCount = $this->linkHelper->searchPostsCount($query);

            if ($totalCount === 0) {
                return "I couldn't find any posts about '{$query}'. Try a different search term.";
            }

            $searchUrl = $this->linkHelper->getSearchUrl($query);

            return "I found {$totalCount} posts about '{$query}'. Use the search page to find them all: [Search '{$query}']({$searchUrl})";
        }

        if ($count > self::MAX_INDIVIDUAL_LINKS) {
            $searchUrl = $this->linkHelper->getSearchUrl($query);

            return "I found many posts about '{$query}'. Use the search page to find them all: [Search '{$query}']({$searchUrl})";
        }

        $formatted = $this->linkHelper->formatLinks($links);

        if ($count === 1) {
            return "Post about '{$query}': {$formatted}";
        }

        return "Posts about '{$query}': {$formatted}";
    }
}
