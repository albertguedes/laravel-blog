<?php

declare(strict_types=1);

namespace App\View\Components\Common;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tree extends Component
{
    public array $tree;

    public function __construct()
    {
        $this->tree = self::getCategoryTree();
    }

    public function render(): View|\Closure|string
    {
        return view('components.common.tree');
    }

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
            $item = self::categoryItem($category, $level);
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

    public static function categoryItem(?Category $category = null, int $level = 0): array
    {
        return $category === null ? [] : [
            'id' => $category->id,
            'title' => $category->title,
            'slug' => $category->slug,
            'level' => $level,
            'count_posts' => self::countPosts($category),
        ];
    }

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
