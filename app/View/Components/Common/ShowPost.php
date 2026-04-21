<?php

declare(strict_types=1);

namespace App\View\Components\Common;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ShowPost extends Component
{
    public function __construct(public Post $post) {}

    public function render(): View|Closure|string
    {
        return view('components.common.show-post');
    }
}
