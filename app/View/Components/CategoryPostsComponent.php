<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;

class CategoryPostsComponent extends Component
{
    public $category;

    public $posts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($category)
    {
        $this->category = $category;

        $this->posts = $this->category_posts($category);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.category-posts-component');
    }

    /**
     * Get all posts of a category and of the children recursively
     * change on a formatted array ready to print.
     *
     * @param Category $category
     * @return array
     */
    public function category_posts (Category $category): array
    {
        $posts = [];

        // Get posts of current category.
        foreach($category->posts(true)->get() as $post ){
            $posts[] = [
                'title' => $post->title,
                'author' => $post->author->name,
                'route' => route('post', compact('post') )
            ];
        }

        // Get children posts to add on current category.
        if( $category->children->count() > 0 ){
            foreach ($category->children as $children) {
                $children_posts = $this->category_posts($children);
                $posts = array_merge($posts,$children_posts);
            }
        }

        // Sort posts by title.
        usort($posts, function($a, $b) {
            return strcmp($a['title'], $b['title']);
        });

        return $posts;
    }
}
