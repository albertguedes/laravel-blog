<?php 

namespace App\Custom;

/**
 * Custom class to create a tree for categies.
 */
class TreeCategory {

    /**
     * Generate a category tree.
     */
    public static function generate( \App\Models\Category $category = null )
    {

        $html="<h2>\n";
        $html.="<a href='#category-".$category->id."' role='button' 
        data-bs-toggle='collapse' 
        aria-expanded='false' 
        aria-controls='category-".$category->id."' >\n";
        $html.=$category->title;
        $html.="</a>\n";
        $html.="</h2>\n";
        if( count($category->children) > 0 ){
            $html.="<ul id='category-".$category->id."' class='list collapse ps-5' >\n";
            foreach( $category->children as $child ){
                $html.="<li>\n";
                $html.= TreeCategory::generate($child);
                $html.="</li>\n";
            }
            $html.="</ul>\n";
        }  
        else {
            if( count($category->posts) > 0 ){
                $html.="<ul id='category-".$category->id."' class='list collapse ps-5' >\n";
                foreach( $category->posts->sortBy('title') as $post ){
                    if($post->published){
                        $html.="<li class='pb-2'>\n";
                        $html.="<h5><a href='".route('post',['post'=>$post])."' >".ucwords($post->title)."</a></h5>\n";
                        $html.="<h6 class='text-black-50' >by <em>".ucwords($post->author->name)."</em></h6>\n";
                        $html.="</li>\n";
                    }
                }
                $html.="</ul>\n";
            }
        }

        return $html;

    }

}