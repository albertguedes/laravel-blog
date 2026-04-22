<?php

declare(strict_types=1);

namespace App\View\Components\Authors;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Author link component.
 *
 * Renders a clickable link to an author's profile page.
 * Retrieves author data by ID and generates appropriate route.
 */
class Link extends Component
{
    /** @var string URL to author's profile page */
    public string $route;

    /** @var string Author's display name */
    public string $name;

    /** @var int Whether author is active */
    public int $is_active;

    /**
     * Create a new component instance.
     *
     * @param  int  $authorId  The author's user ID
     *
     * @throws \Exception If author ID is not provided or author not found
     */
    public function __construct(int $authorId)
    {
        if (! $authorId) {
            throw new \Exception('author is required');
        }

        $author = User::findOrFail($authorId);

        if (! $author) {
            throw new \Exception('author not found');
        }

        $this->route = route('author', ['author' => $author->profile->username]);
        $this->name = $author->profile->name;
        $this->is_active = $author->is_active;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.authors.link');
    }
}
