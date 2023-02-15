<?php

use App\Models\Category;
use App\Models\Tag;

if(!function_exists('category_select')){

    /**
     * Create selector for categories.
     *
     * @param string $name - The name of select form.
     * @param \App\Models\Category $current - case is on update form, current is the current category for update.
     *
     * @return string $html;
     */
    function category_select( string $name = '', Category $current = null ){

        // Get root category.
        $root = Category::where('parent_id',null)->with('parent','children')->first();

        $html="<select class='form-select' aria-label='Category Selector' name='".$name."' >";
        $html.=category_select_option($root,0,$current);
        $html.="</select>";

        return $html;

    }

    /**
     * Create option of selector and options of subcategory if exists.
     *
     * @param \App\Models\Category $category
     *
     * @return string $html;
     */
    function category_select_option( Category $category = null, int $level = 0, Category $current = null ){

        $html='';
        if( !is_null($category) ){

            // Verify if category is the same of current category.
            $is_current = ( !is_null($current) && ( $category->id == $current->id) );
            ( $is_current ) ? $selected="selected='selected'" : $selected="";

            $html.="<option value='".$category->id."' ".$selected." >".str_repeat('-',$level)." ".$category->title."</option>";
            // If $category has children, print then.
            if( count($category->children) > 0 ){
                foreach( $category->children as $child ){
                    $html.=category_select_option($child,$level+1,$current);
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
     * @param array $tags_selected - an array with ids of previously checked tags.
     *
     * @return $html - the html code with the checkbox to select.
     *
     */
    function tags_checkbox( array $tags_selected = [] ){

        $tags = Tag::IsActive()
                    ->select(['id','title'])
                    ->orderBy('title','asc')
                    ->get();

        $html="";
        foreach($tags as $tag){


            // Verify if exists tags previouly selected.
            // If yes, checked the checkbox of that tag.
            $checked='';
            if( count($tags_selected) > 0 ){
                foreach( $tags_selected as $tag_id ){
                    if($tag->id == $tag_id) $checked="checked='checked'";
                }
            }

            $html.="<input type='checkbox' value='".$tag->id."' ".$checked." >&nbsp;";
            $html.=ucwords($tag->title);
            $html.="&nbsp;";

        }

        return $html;

    }

}
