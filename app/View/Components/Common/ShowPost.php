<?php

declare(strict_types=1);

namespace App\View\Components\Common;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Post display component.
 *
 * Renders a single post in a card format suitable for listing pages.
 * Displays post title, excerpt, author, date, category, and tags.
 */
class ShowPost extends Component
{
    /**
     * Create a new component instance.
     *
     * @param  Post  $post  The post model to display
     */
    public function __construct(public Post $post) {}

    /**
     * Get the view / view contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.common.show-post');
    }
}
