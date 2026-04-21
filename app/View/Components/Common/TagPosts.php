<?php

declare(strict_types=1);

namespace App\View\Components\Common;

use App\Models\Tag;
use Illuminate\View\Component;
use Illuminate\View\View;

class TagPosts extends Component
{
    public Tag $tag;

    public $posts;

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
        return view('components.common.tag-posts');
    }
}
