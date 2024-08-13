<?php

namespace App\View\Components;

use App\Models\Tag;
use Illuminate\View\Component;

class TagPostsComponent extends Component
{
    public $tag;

    public $posts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tag)
    {
        $this->tag = $tag;
        $this->posts = $tag->posts()->Published()->orderBy('title','asc')->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tag-posts-component');
    }
}
