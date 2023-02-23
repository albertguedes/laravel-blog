<?php

namespace App\View\Components;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\View\Component;

class TagFormComponent extends Component
{

    public $html;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( Post $post = null )
    {
        $this->html = $this->tags_checkboxes($post);
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
     * @return $html
     */
    function tags_checkboxes( Post $post = null ): string {

        $tags = Tag::IsActive()
                    ->select(['id','title'])
                    ->orderBy('title','asc')
                    ->get();

        $html="";
        foreach($tags as $tag){

            // Verify if exists tags previouly selected.
            // If yes, checked the checkbox of that tag.
            $checked='';
            if( $post && $post->tags->count() > 0 ){
                foreach( $post->tags as $curr_tag ){
                    if($tag->id == $curr_tag->id) $checked="checked='checked'";
                }
            }

            $html.="<input type='checkbox' name='post[tags][]' value='".$tag->id."' ".$checked." >&nbsp;&nbsp;&nbsp;";
            $html.=ucwords($tag->title);
            $html.="<br><br>";

        }

        return $html;

    }

}
