<?php

declare(strict_types=1);

namespace App\View\Components\Common;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Tags checkbox form component.
 *
 * Generates a list of active tags as checkboxes for post editing forms.
 * Pre-selects tags that are already assigned to the post.
 */
class TagsForm extends Component
{
    /** @var array<int, array{id: int, title: string, checked: bool}> Tag checkbox items */
    public array $tags = [];

    /**
     * Create a new component instance.
     *
     * @param  Post|null  $post  Post whose tags should be pre-selected (optional)
     */
    public function __construct(?Post $post = null)
    {
        $this->tags = $this->tagsCheckboxes($post);
    }

    /**
     * Get the view / view contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|\Closure|string
    {
        return view('components.common.tags-form');
    }

    /**
     * Build tag checkbox items list.
     *
     * Retrieves all active tags and builds checkbox items with checked state.
     * If a post is provided, its assigned tags will be pre-selected.
     *
     * @param  Post|null  $post  Post to check tags against (optional)
     * @return array<int, array{id: int, title: string, checked: bool}>
     */
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
