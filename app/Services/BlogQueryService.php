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
    /**
     * Get post count with optional filters.
     *
     * @param  array  $filters  Optional filters: published, author_id, category_id, tag_id
     */
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

    /**
     * Get published posts by author.
     */
    public function getPostsByAuthor(int $authorId, int $limit = 10): Collection
    {
        return Post::where('author_id', $authorId)
            ->where('published', true)
            ->orderBy('updated_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get published posts by category.
     */
    public function getPostsByCategory(int $categoryId, int $limit = 10): Collection
    {
        return Post::where('category_id', $categoryId)
            ->where('published', true)
            ->orderBy('updated_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get published posts by tag.
     */
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

    /**
     * Get recent published posts.
     */
    public function getRecentPosts(int $limit = 5): Collection
    {
        return Post::where('published', true)
            ->orderBy('updated_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Search posts by title.
     */
    public function getPostsByTitle(string $searchQuery, int $limit = 10): Collection
    {
        return Post::where('title', 'like', "%{$searchQuery}%")
            ->where('published', true)
            ->orderBy('updated_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get active authors (has published posts and is_active).
     */
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

    /**
     * Get inactive authors (has published posts but is_active=false).
     */
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

    /**
     * Get statistics for an author.
     *
     * @return array{author: ?User, post_count: int, category_count: int, recent_posts: Collection}
     */
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

    /**
     * Get active categories with post counts.
     */
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

    /**
     * Get active tags with post counts.
     */
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

    /**
     * Get statistics for a category.
     *
     * @return array{category: ?Category, post_count: int, recent_posts: Collection}
     */
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

    /**
     * Find an author by name (partial match).
     */
    public function findAuthorByName(string $name): ?User
    {
        return User::whereHas('profile', function ($q) use ($name) {
            $q->where('name', 'like', "%{$name}%");
        })->first();
    }

    /**
     * Find a category by title (partial match).
     */
    public function findCategoryByName(string $name): ?Category
    {
        return Category::where('title', 'like', "%{$name}%")
            ->where('is_active', true)
            ->first();
    }

    /**
     * Find a tag by title (partial match).
     */
    public function findTagByName(string $name): ?Tag
    {
        return Tag::where('title', 'like', "%{$name}%")
            ->where('is_active', true)
            ->first();
    }

    /**
     * Get active authors ordered by post count.
     */
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

    /**
     * Get active categories ordered by post count.
     */
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

    /**
     * Get all authors with post counts.
     */
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
