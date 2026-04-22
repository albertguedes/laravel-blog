<?php

declare(strict_types=1);

namespace App\View\Components\Categories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\View\Component;
use Illuminate\View\View;

class CategoryPosts extends Component
{
    public Category $category;

    public $posts;

    public function __construct(Category $category)
    {
        if (! $category) {
            throw new \Exception('category is required');
        }

        $this->category = $category;
        $this->posts = $this->postsFromCategoryTree($category)
            ->paginate(5);
    }

    public function render(): View
    {
        return view('components.categories.category-posts');
    }

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

    public function categoryTreeIds(Category $category): array
    {
        $ids = [$category->id];

        foreach ($category->children as $child) {
            $ids = array_merge($ids, $this->categoryTreeIds($child));
        }

        return $ids;
    }
}
