<?php

namespace App\Http\Controllers;

use App\Custom\TreeCategory;
use App\Models\Category;

class CategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $root = Category::where('parent_id',null)->first();

        $tree = TreeCategory::generate($root);

        return view('categories',compact('tree'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show( Category $category )
    {

        if($category->is_active){
            return view('category',compact('category'));
        }

        return redirect()->route('404');
        
    }
   
}
