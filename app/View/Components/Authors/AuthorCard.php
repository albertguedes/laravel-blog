<?php

declare(strict_types=1);

namespace App\View\Components\Authors;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Author card display component.
 *
 * Renders an author card showing their name, profile info, and post count.
 * Used on author listing pages.
 */
class AuthorCard extends Component
{
    /** @var int Number of published posts by this author */
    public int $posts_count;

    /**
     * Create a new component instance.
     *
     * @param  User  $author  The author user to display
     */
    public function __construct(public User $author)
    {
        $this->posts_count = $author->posts()->where('published', true)->count();
    }

    /**
     * Get the view / view contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.authors.author-card', [
            'isActive' => $this->author->is_active,
        ]);
    }
}
