<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;


if(!function_exists('tags_checkbox')){

    /**
     * Generate a set of checkbox to select the tags.
     *
     * @param Post $post
     * @return $html
     */
    function tags_checkbox( Post $post = null ): string {

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
