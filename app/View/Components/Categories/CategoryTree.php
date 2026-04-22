<?php

declare(strict_types=1);

namespace App\View\Components\Categories;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Class CategoryTree
 */
class CategoryTree extends Component
{
    public array $tree;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->tree = self::getCategoryTree();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.categories.category-tree');
    }

    /**
     * Get category tree
     */
    public static function getCategoryTree($categories = null, int $level = 0): array
    {
        if ($categories === null) {
            $categories = Category::whereNull('parent_id')
                ->with(['children', 'posts' => function ($query) {
                    $query->where('published', true);
                }])
                ->orderBy('title')
                ->get();
        }

        $tree = [];
        foreach ($categories as $category) {
            $item = self::categoryToArray($category, $level);
            $hasPosts = $item['count_posts'] > 0;

            if ($category->is_active) {
                if ($hasPosts || $category->children->count() > 0) {
                    if ($hasPosts) {
                        $tree[] = $item;
                    }

                    if ($category->children->count() > 0) {
                        $childTree = self::getCategoryTree($category->children, $level + 1);
                        foreach ($childTree as $child) {
                            $child['level'] = $hasPosts ? $item['level'] + 1 : $item['level'];
                            $tree[] = $child;
                        }
                    }

                    if (! $hasPosts && $category->children->count() === 0) {
                    }
                }
            } else {
                if ($category->children->count() > 0) {
                    $childTree = self::getCategoryTree($category->children, $level);
                    foreach ($childTree as $child) {
                        $child['level'] = $level;
                        $tree[] = $child;
                    }
                }
            }
        }

        return $tree;
    }

    /**
     * Convert category to array
     */
    public static function categoryToArray(?Category $category = null, int $level = 0): array
    {
        return $category === null ? [] : [
            'id' => $category->id,
            'title' => $category->title,
            'slug' => $category->slug,
            'level' => $level,
            'count_posts' => self::countPosts($category),
        ];
    }

    /**
     * Count posts in category and its children
     */
    public static function countPosts(Category $category): int
    {
        $count = $category->posts()
            ->where('published', true)
            ->count();

        if ($category->children->count() > 0) {
            foreach ($category->children as $childCategory) {
                $count += self::countPosts($childCategory);
            }
        }

        return $count;
    }
}
