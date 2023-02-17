<?php

namespace App\Http\Controllers;

use App\Custom\TreeCategory;
use App\Models\Category;

use Illuminate\View\View;

class CategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {

        $root = Category::where('parent_id',null)->first();

        $tree = TreeCategory::generate($root);

        return view('categories',compact('tree'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category $category
     * @return \Illuminate\View\View
     */
    public function show( Category $category ): View
    {
        return view('category',compact('category'));
    }

}
