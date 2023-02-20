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
     * Get all posts of a category and of the children recursively.
     *
     * @param Category $category
     * @return array
     */
    public function category_posts( Category $category ): array {

        $posts = [];

        foreach($category->posts(true) as $post ){

            $posts[] = [
                'title' => $post->title,
                'author' => $post->author->name,
                'route' => route('post', compact('post') )
            ];

        }

        if( $category->children->count() > 0 ){
            foreach ($category->children as $children) {
                $children_posts = $this->category_posts($children);
                $posts = array_merge($posts,$children_posts);
            }
        }

        return $posts;

    }

}
