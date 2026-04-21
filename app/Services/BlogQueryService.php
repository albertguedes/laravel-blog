<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Collection;

/**
 * Blog query service for retrieving posts, authors, categories, and tags.
 *
 * @author Albert
 *
 * @since 1.0.0
 */
class BlogQueryService
{
    public function getPostCount(array $filters = []): int
    {
        $query = Post::query();

        if (isset($filters['published'])) {
            $query->where('published', (bool) $filters['published']);
        }

        if (isset($filters['author_id'])) {
            $query->where('author_id', $filters['author_id']);
        }

        if (isset($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (isset($filters['tag_id'])) {
            $query->whereHas('tags', function ($q) use ($filters) {
                $q->where('tags.id', $filters['tag_id']);
            });
        }

        return $query->count();
    }

    public function getPostsByAuthor(int $authorId, int $limit = 10): Collection
    {
        return Post::where('author_id', $authorId)
            ->where('published', true)
            ->orderBy('updated_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getPostsByCategory(int $categoryId, int $limit = 10): Collection
    {
        return Post::where('category_id', $categoryId)
            ->where('published', true)
            ->orderBy('updated_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getPostsByTag(int $tagId, int $limit = 10): Collection
    {
        return Post::whereHas('tags', function ($q) use ($tagId) {
            $q->where('tags.id', $tagId);
        })
            ->where('published', true)
            ->orderBy('updated_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getRecentPosts(int $limit = 5): Collection
    {
        return Post::where('published', true)
            ->orderBy('updated_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getPostsByTitle(string $searchQuery, int $limit = 10): Collection
    {
        return Post::where('title', 'like', "%{$searchQuery}%")
            ->where('published', true)
            ->orderBy('updated_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getActiveAuthors(int $limit = 10): Collection
    {
        return User::whereHas('posts', function ($q) {
            $q->where('published', true);
        })
            ->where('is_active', true)
            ->with('profile')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getInactiveAuthors(int $limit = 10): Collection
    {
        return User::whereHas('posts', function ($q) {
            $q->where('published', true);
        })
            ->where('is_active', false)
            ->with('profile')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getAuthorStats(int $authorId): array
    {
        $author = User::with('profile')->find($authorId);

        if (! $author) {
            return [];
        }

        $postCount = Post::where('author_id', $authorId)
            ->where('published', true)
            ->count();

        $posts = Post::where('author_id', $authorId)
            ->where('published', true)
            ->with('category', 'tags')
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

        $categoryCount = Post::where('author_id', $authorId)
            ->where('published', true)
            ->distinct('category_id')
            ->count('category_id');

        $tagCount = Post::where('author_id', $authorId)
            ->where('published', true)
            ->distinct('category_id')
            ->count('category_id');

        return [
            'author' => $author,
            'post_count' => $postCount,
            'category_count' => $categoryCount,
            'recent_posts' => $posts,
        ];
    }

    public function getCategoriesWithPostCount(): Collection
    {
        return Category::where('is_active', true)
            ->withCount(['posts' => function ($q) {
                $q->where('published', true);
            }])
            ->having('posts_count', '>', 0)
            ->orderBy('posts_count', 'desc')
            ->get();
    }

    public function getTagsWithPostCount(): Collection
    {
        return Tag::where('is_active', true)
            ->withCount(['posts' => function ($q) {
                $q->where('published', true);
            }])
            ->having('posts_count', '>', 0)
            ->orderBy('posts_count', 'desc')
            ->get();
    }

    public function getCategoryStats(int $categoryId): array
    {
        $category = Category::find($categoryId);

        if (! $category) {
            return [];
        }

        $postCount = Post::where('category_id', $categoryId)
            ->where('published', true)
            ->count();

        $posts = Post::where('category_id', $categoryId)
            ->where('published', true)
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

        return [
            'category' => $category,
            'post_count' => $postCount,
            'recent_posts' => $posts,
        ];
    }

    public function findAuthorByName(string $name): ?User
    {
        return User::whereHas('profile', function ($q) use ($name) {
            $q->where('name', 'like', "%{$name}%");
        })->first();
    }

    public function findCategoryByName(string $name): ?Category
    {
        return Category::where('title', 'like', "%{$name}%")
            ->where('is_active', true)
            ->first();
    }

    public function findTagByName(string $name): ?Tag
    {
        return Tag::where('title', 'like', "%{$name}%")
            ->where('is_active', true)
            ->first();
    }

    public function getAuthorsOrderedByPostCount(int $limit = 10): Collection
    {
        return User::whereHas('posts', function ($q) {
            $q->where('published', true);
        })
            ->where('is_active', true)
            ->with('profile')
            ->withCount(['posts' => function ($q) {
                $q->where('published', true);
            }])
            ->orderBy('posts_count', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getCategoriesOrderedByPostCount(int $limit = 10): Collection
    {
        return Category::where('is_active', true)
            ->withCount(['posts' => function ($q) {
                $q->where('published', true);
            }])
            ->orderBy('posts_count', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getAllAuthors(int $limit = 20): Collection
    {
        return User::with('profile')
            ->withCount(['posts' => function ($q) {
                $q->where('published', true);
            }])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
