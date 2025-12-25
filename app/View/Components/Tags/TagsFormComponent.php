<?php declare(strict_types=1);

namespace App\View\Components\Tags;

use Illuminate\View\Component;

use App\Models\Post;
use App\Models\Tag;

class TagsFormComponent extends Component
{
    public array $tags = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( ?Post $post = null)
    {
        $this->tags = $this->tagsCheckboxes($post);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tags.tags-form-component');
    }

    /**
     * Generate a set of checkbox to select the tags.
     *
     * @param Post $post
     *
     * @return array $list
     */
    function tagsCheckboxes (?Post $post = null): array
    {
        $tags = Tag::where('is_active',true)
                    ->select(['id','title'])
                    ->orderBy('title','asc')
                    ->get();

        $list = [];

        foreach ($tags as $tag)
        {
            $item = [];
            $item['id'] = $tag->id;
            $item['title'] = $tag->title;
            $item['checked'] = false;

            // Verify if exists tags previouly selected.
            // If yes, checked the checkbox of that tag.
            if ( !is_null($post) && ($post->tags->count() > 0)) {
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
