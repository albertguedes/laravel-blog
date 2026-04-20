<?php

declare(strict_types=1);

namespace App\View\Components\Tags;

use App\Models\Tag;
use Illuminate\View\Component;
use Illuminate\View\View;

class PostsComponent extends Component
{
    public Tag $tag;

    public $posts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
        $this->posts = $tag->posts()
            ->where('published', true)
            ->orderBy('title', 'ASC')
            ->paginate(5);
    }

    public function render(): View
    {
        return view('components.tags.posts-component');
    }
}
