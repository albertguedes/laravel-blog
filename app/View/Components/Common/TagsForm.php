<?php

declare(strict_types=1);

namespace App\View\Components\Common;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TagsForm extends Component
{
    public array $tags = [];

    public function __construct(?Post $post = null)
    {
        $this->tags = $this->tagsCheckboxes($post);
    }

    public function render(): View|\Closure|string
    {
        return view('components.common.tags-form');
    }

    public function tagsCheckboxes(?Post $post = null): array
    {
        $tags = Tag::where('is_active', true)
            ->select(['id', 'title'])
            ->orderBy('title', 'asc')
            ->get();

        $list = [];

        foreach ($tags as $tag) {
            $item = [];
            $item['id'] = $tag->id;
            $item['title'] = $tag->title;
            $item['checked'] = false;

            if (! is_null($post) && ($post->tags->count() > 0)) {
                $curr_tags_ids = $post->tags->pluck('id')->toArray();
                if (in_array($tag->id, $curr_tags_ids)) {
                    $item['checked'] = true;
                }
            }

            $list[] = $item;
        }

        return $list;
    }
}
