<?php

declare(strict_types=1);

namespace App\View\Components\Categories;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Class responsible for generating a hierarchical tree structure of categories, including children categories.
 */
class TreeComponent extends Component
{
    /**
     * The tree structure of categories and their children.
     */
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
     *
     * @return View|\Closure|string
     */
    public function render()
    {
        return view('components.categories.tree-component');
    }

    /**
     * Generate a hierarchical tree structure of categories, including children categories.
     *
     * @param  Category|null  $category  The starting category to build the tree from
     * @return array The hierarchical tree structure of categories and their children
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
            if (!$category->is_active) {
                if ($category->children->count() > 0) {
                    $tree = array_merge($tree, self::getCategoryTree($category->children, $level));
                }
                continue;
            }

            $tree[] = self::categoryItem($category, $level);

            if (last($tree)['count_posts'] > 0) {
                if ($category->children->count() > 0) {
                    $tree = array_merge($tree, self::getCategoryTree($category->children, $level + 1));
                }
            } elseif ($category->children->count() === 0) {
                array_pop($tree);
            } else {
                $tree = array_merge($tree, self::getCategoryTree($category->children, $level + 1));
            }
        }

        return $tree;
    }

    /**
     * Generate an array containing the category item information.
     *
     * @param  Category  $category  The category item to generate the array for
     * @param  int  $level  The level of the category in the tree structure
     * @return array The category item information
     */
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

    /**
     * Counts the total number of posts belonging to a category, including posts
     * in its children categories.
     *
     * @param  Category  $category  The category to count posts for
     * @return int The total number of posts
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
