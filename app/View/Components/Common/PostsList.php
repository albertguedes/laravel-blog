<?php

declare(strict_types=1);

namespace App\View\Components\Common;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;

class PostsList extends Component
{
    public function __construct(public LengthAwarePaginator $posts) {}

    public function render(): View|Closure|string
    {
        return view('components.common.posts-list');
    }
}
