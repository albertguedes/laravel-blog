<?php

declare(strict_types=1);

namespace App\View\Components\Profile\Posts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;

/**
 * Posts list component.
 *
 * Renders a paginated list of the user's posts with edit/delete actions.
 * Displays post title, status, category, and dates.
 */
class PostsList extends Component
{
    /** @var LengthAwarePaginator Paginated posts collection */
    public function __construct(public LengthAwarePaginator $posts) {}

    /**
     * Get the view / view contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.profile.posts.posts-list');
    }
}
