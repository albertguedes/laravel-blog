<?php

declare(strict_types=1);

namespace App\View\Components\Tags;

use App\Models\Tag;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * Tag posts display component.
 *
 * Renders posts associated with a specific tag in a paginated list.
 */
class TagPosts extends Component
{
    /** @var Tag The tag to display posts for */
    public Tag $tag;

    /** @var LengthAwarePaginator Paginated posts */
    public $posts;

    /**
     * Create a new component instance.
     *
     * @param  Tag  $tag  The tag to display posts for
     */
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
        $this->posts = $tag->posts()
            ->where('published', true)
            ->orderBy('title', 'ASC')
            ->paginate(5);
    }

    /**
     * Get the view / view contents that represent the component.
     */
    public function render(): View
    {
        return view('components.tags.tag-posts');
    }
}
