<?php declare(strict_types=1);

namespace App\View\Components\Authors;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\User;

class AuthorCardComponent extends Component
{
    public int $posts_count;

    /**
     * Create a new component instance.
     */
    public function __construct (public User $author) {
        $this->posts_count = $author->posts()->where('published',true)->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.authors.author-card-component');
    }
}
