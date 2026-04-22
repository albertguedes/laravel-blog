<?php

declare(strict_types=1);

namespace App\View\Components\Categories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * Category posts display component.
 *
 * Renders posts belonging to a category and all its subcategories.
 * Supports hierarchical category browsing.
 */
class CategoryPosts extends Component
{
    /** @var Category The category to display posts for */
    public Category $category;

    /** @var LengthAwarePaginator Paginated posts */
    public $posts;

    /**
     * Create a new component instance.
     *
     * @param  Category  $category  The category to display posts for
     *
     * @throws \Exception If category is not provided
     */
    public function __construct(Category $category)
    {
        if (! $category) {
            throw new \Exception('category is required');
        }

        $this->category = $category;
        $this->posts = $this->postsFromCategoryTree($category)
            ->paginate(5);
    }

    /**
     * Get the view / view contents that represent the component.
     */
    public function render(): View
    {
        return view('components.categories.category-posts');
    }

    /**
     * Get posts from category and all its children.
     *
     * @param  Category  $category  The root category
     * @return Builder
     *
     * @throws \Exception If category is not provided
     */
    public function postsFromCategoryTree(Category $category)
    {
        if (! $category) {
            throw new \Exception('category is required');
        }

        $categoryIds = $this->categoryTreeIds($category);

        return Post::whereIn('category_id', $categoryIds)
            ->where('published', true)
            ->orderBy('title', 'ASC');
    }

    /**
     * Recursively get all category IDs including children.
     *
     * @param  Category  $category  The category to get IDs from
     * @return array<int> Array of category IDs
     */
    public function categoryTreeIds(Category $category): array
    {
        $ids = [$category->id];

        foreach ($category->children as $child) {
            $ids = array_merge($ids, $this->categoryTreeIds($child));
        }

        return $ids;
    }
}
