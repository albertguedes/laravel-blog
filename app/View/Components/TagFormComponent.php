<?php

namespace App\View\Components;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\View\Component;

class TagFormComponent extends Component
{
    public array $tags = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( Post $post = null)
    {
        $this->tags = $this->tags_checkboxes($post);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tag-form-component');
    }

    /**
     * Generate a set of checkbox to select the tags.
     *
     * @param Post $post
     *
     * @return array $list
     */
    function tags_checkboxes( Post $post = null ): array
    {
        $tags = Tag::IsActive()
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
                foreach( $post->tags as $curr_tag ){
                    if($tag->id == $curr_tag->id) $item['checked'] = true;
                }
            }

            $list[] = $item;
        }

        return $list;
    }
}
