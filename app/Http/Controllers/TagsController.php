<?php

namespace App\Http\Controllers;

use App\Models\Tag;

use Illuminate\View\View;

class TagsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {

        $tags = Tag::IsActive()->select('slug','title')
                               ->orderBy('title','ASC');

        return view('tags',compact('tags'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag $tag
     * @return \Illuminate\View\View
     */
    public function show(Tag $tag)
    {
        return view('tag',compact('tag'));
    }

}
