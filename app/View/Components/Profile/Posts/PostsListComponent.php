<?php declare(strict_types=1);

namespace App\View\Components\Profile\Posts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Pagination\LengthAwarePaginator;

class PostsListComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct (public LengthAwarePaginator $posts) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.profile.posts.posts-list-component');
    }
}
