<?php declare(strict_types=1);

namespace App\View\Components\Categories;

use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Illuminate\View\View;

use App\Models\Category;
use App\Models\Post;

class PostsComponent extends Component
{
    public Category $category;
    public $posts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct (Category $category)
    {
        if (!$category) {
            throw new \Exception('category is required');
        }

        $this->category = $category;
        $this->posts = $this->postsFromCategoryTree($category)
                            ->paginate(5);
    }

    /**
     * Renders the view for the posts component.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('components.categories.posts-component');
    }

    /**
     * Returns a collection of posts from the category tree starting from the given category.
     * The posts are filtered by the 'published' field and ordered by the 'created_at' field in descending order.
     *
     * @param Category $category The starting category of the tree.
     *
     * @return Collection A collection of posts from the category tree.
     */
    public function postsFromCategoryTree(Category $category)
    {
        if (!$category) {
            throw new \Exception('category is required');
        }

        $categoryIds = $this->categoryTreeIds($category);

        return Post::whereIn('category_id', $categoryIds)
                    ->where('published', true)
                    ->orderBy('title', 'ASC');
    }

    /**
     * Return an array of ids of all categories in the tree starting from $category.
     *
     * @param Category $category
     * @return array
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
