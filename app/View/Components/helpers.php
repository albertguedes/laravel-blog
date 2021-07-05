<?php 

use App\Models\Category;

if(!function_exists('category_select')){

    /**
     * Create selector for categories.
     * 
     * @param string $name
     * @param int $selected_id
     * 
     * @return string $html;
     */
    function category_select( string $name = '', Category $current = null ){

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
     * @param int $selected_id
     * 
     * @return string $html;
     */
    function category_select_option( Category $category = null, int $level = 0, Category $current = null ){

        $html='';

        if( !is_null($category) ){

            $selected="";
            if( $current && ( $category->id == $current->id ) ) $selected="selected='selected'";

            $html.="<option value='".$category->id."' ".$selected." >".str_repeat('-',$level)." ".$category->title."</option>";

            // Prevent that children categories of current category be showed to not set a child category as parent,
            // creating a circular category.
            if( ($category != $current) && (count($category->children) > 0) ){
                foreach($category->children as $child ){
                    $html.=category_select_option($child,$level+1,$current);
                }
            }

        }

        return $html;

    }

}