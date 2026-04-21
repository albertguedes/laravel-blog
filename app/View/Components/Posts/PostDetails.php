<?php

declare(strict_types=1);

namespace App\View\Components\Posts;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Component for displaying post details.
 *
 * @author Albert
 *
 * @since 1.0.0
 */
class PostDetails extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Post $post) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.posts.post-details');
    }
}
