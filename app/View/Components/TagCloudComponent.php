<?php

namespace App\View\Components;

use App\Models\Tag;
use Illuminate\View\Component;

class TagCloudComponent extends Component
{
    public $tags = [];

    protected const MIN_FONT_SIZE = 15;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $tags = Tag::IsActive()->orderBy('title')->get();

        foreach ($tags as $tag) {
            $this->tags[] = [
                'id' => $tag->id,
                'title' => $tag->title,
                'n_posts' => $tag->posts()->Published()->count(),
                'font_size' => 'style=font-size:' . ( 2*$tag->posts->count() + self::MIN_FONT_SIZE ) . 'px;',
            ];
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tag-cloud-component');
    }
}
