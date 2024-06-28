<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\View\Component;

class LatestPostsComponent extends Component
{

    public $latest_posts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->latest_posts = Post::Published()->select('slug','title','created_at','author_id','description')
                                  ->orderBy('created_at','DESC')
                                  ->paginate(5);

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.latest-posts-component');
    }

}
