<?php

declare(strict_types=1);

namespace App\View\Components\Common;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AuthorCard extends Component
{
    public int $posts_count;

    public function __construct(public User $author)
    {
        $this->posts_count = $author->posts()->where('published', true)->count();
    }

    public function render(): View|Closure|string
    {
        return view('components.common.author-card', [
            'isActive' => $this->author->is_active,
        ]);
    }
}
