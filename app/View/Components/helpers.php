<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

if(!function_exists('category_select')){

    /**
     * Create selector for categories.
     *
     * @param string $name - The name of select form.
     * @param \App\Models\Category $current - case is on update form, current is the current category for update.
     *
     * @return string $html;
     */
    function category_select( Category $current = null, string $name ): string {

        // Get all roots categories.
        $roots = Category::where('parent_id',null)
                        ->with('children')
                        ->orderBy('title')
                        ->get();

        if (!$current) {
            $current = $roots->first();
        }

        $html="<select class='form-select' aria-label='Category Selector' name='{$name}' >";
        $html.="<option value='0' >None</option>";
        $html.=category_select_option($roots,0,$current);
        $html.="</select>";

        return $html;

    }

    /**
     * Create option of selector and options of subcategory if exists.
     *
     * @param Collection $categories
     *
     * @return string $html;
     */
    function category_select_option( Collection $categories, int $level, Category $current ): string {

        $html='';
        if( count($categories) > 0 ){
            foreach ($categories as $category) {

                ($category->id == $current->id ) ? $selected="selected='selected'": $selected="";

                $html.="<option value='{$category->id}' {$selected} >".str_repeat('-',$level).$category->title."</option>";
                if($category->children){
                    $html.=category_select_option($category->children,$level+1,$current);
                }

            }
        }

        return $html;

    }

}

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
