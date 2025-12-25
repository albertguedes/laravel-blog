<?php declare(strict_types=1);

namespace App\View\Components\Authors;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\User;

class Link extends Component
{
    public string $route;
    public string $name;
    public int $is_active;

    /**
     * Create a new component instance.
     */
    public function __construct(int $authorId)
    {
        if (!$authorId) {
            throw new \Exception('author is required');
        }

        $author = User::findOrFail($authorId);

        if (!$author) {
            throw new \Exception('author not found');
        }

        $this->route = route('author', $author);
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
