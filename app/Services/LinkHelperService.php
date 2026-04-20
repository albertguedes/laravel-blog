<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\URL;

class LinkHelperService
{
    private const MAX_INDIVIDUAL_LINKS = 10;

    private function getPath(string $url): string
    {
        return parse_url($url, PHP_URL_PATH);
    }

    public function getPageLink(string $page): string
    {
        $page = mb_strtolower($page);

        $routes = [
            'home' => ['route' => 'home', 'title' => 'Home'],
            'about' => ['route' => 'about', 'title' => 'About'],
            'contact' => ['route' => 'contact', 'title' => 'Contact'],
            'archive' => ['route' => 'archive', 'title' => 'Archive'],
            'chat' => ['route' => 'chat', 'title' => 'Chat'],
            'categories' => ['route' => 'categories', 'title' => 'Categories'],
            'tags' => ['route' => 'tags', 'title' => 'Tags'],
            'authors' => ['route' => 'authors', 'title' => 'Authors'],
            'search' => ['route' => 'search', 'title' => 'Search'],
        ];

        if (! isset($routes[$page])) {
            return '';
        }

        $url = URL::route($routes[$page]['route']);
        $path = $this->getPath($url);
        $title = $routes[$page]['title'];

        return "[{$title}]({$path})";
    }

    public function getCategoryLinks(?string $slug = null): array
    {
        if ($slug) {
            $category = Category::where('is_active', true)
                ->where('slug', 'like', "%{$slug}%")
                ->first();

            if ($category) {
                return [[
                    'title' => $category->title,
                    'url' => $this->getPath(URL::route('category', ['category' => $category])),
                ]];
            }

            return [];
        }

        return Category::where('is_active', true)
            ->orderBy('title')
            ->limit(self::MAX_INDIVIDUAL_LINKS)
            ->get()
            ->map(fn ($cat) => [
                'title' => $cat->title,
                'url' => $this->getPath(URL::route('category', ['category' => $cat])),
            ])
            ->all();
    }

    public function getTagLinks(?string $slug = null): array
    {
        if ($slug) {
            $tag = Tag::where('is_active', true)
                ->where('slug', 'like', "%{$slug}%")
                ->first();

            if ($tag) {
                return [[
                    'title' => $tag->title,
                    'url' => $this->getPath(URL::route('tag', ['tag' => $tag])),
                ]];
            }

            return [];
        }

        return Tag::where('is_active', true)
            ->orderBy('title')
            ->limit(self::MAX_INDIVIDUAL_LINKS)
            ->get()
            ->map(fn ($tag) => [
                'title' => $tag->title,
                'url' => $this->getPath(URL::route('tag', ['tag' => $tag])),
            ])
            ->all();
    }

    public function getAuthorLinks(?string $slug = null): array
    {
        if ($slug) {
            $author = User::where('is_active', true)
                ->where('slug', 'like', "%{$slug}%")
                ->first();

            if ($author) {
                return [[
                    'title' => $author->name,
                    'url' => $this->getPath(URL::route('author', ['author' => $author])),
                ]];
            }

            return [];
        }

        return User::where('is_active', true)
            ->orderBy('name')
            ->limit(self::MAX_INDIVIDUAL_LINKS)
            ->get()
            ->map(fn ($user) => [
                'title' => $user->name,
                'url' => $this->getPath(URL::route('author', ['author' => $user])),
            ])
            ->all();
    }

    public function getRecentPosts(int $limit = 5): array
    {
        return Post::where('status', 'published')
            ->whereHas('author', fn ($q) => $q->where('is_active', true))
            ->orderBy('published_at', 'desc')
            ->limit($limit)
            ->get()
            ->map(fn ($post) => [
                'title' => $post->title,
                'url' => $this->getPath(URL::route('post', ['post' => $post])),
            ])
            ->all();
    }

    public function searchPosts(string $query): array
    {
        $sanitized = addcslashes($query, '%_');

        return Post::where('status', 'published')
            ->whereHas('author', fn ($q) => $q->where('is_active', true))
            ->where(fn ($q) => $q->where('title', 'like', "%{$sanitized}%"))
            ->orderBy('published_at', 'desc')
            ->limit(self::MAX_INDIVIDUAL_LINKS)
            ->get()
            ->map(fn ($post) => [
                'title' => $post->title,
                'url' => $this->getPath(URL::route('post', ['post' => $post])),
            ])
            ->all();
    }

    public function searchPostsCount(string $query): int
    {
        $sanitized = addcslashes($query, '%_');

        return Post::where('status', 'published')
            ->whereHas('author', fn ($q) => $q->where('is_active', true))
            ->where(fn ($q) => $q->where('title', 'like', "%{$sanitized}%"))
            ->count();
    }

    public function getSearchUrl(string $query): string
    {
        $path = $this->getPath(URL::route('search'));

        return $path.'?q='.urlencode($query);
    }

    public function formatLinks(array $links): string
    {
        if (empty($links)) {
            return '';
        }

        $formatted = array_map(fn ($link) => "[{$link['title']}]({$link['url']})", $links);

        return implode(', ', $formatted);
    }

    public function formatLinksWithPrefix(string $prefix, array $links): string
    {
        if (empty($links)) {
            return '';
        }

        return $prefix.': '.$this->formatLinks($links);
    }
}
