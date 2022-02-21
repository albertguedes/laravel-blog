<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tags = Tag::IsActive()->select('slug','title')
                               ->orderBy('title','ASC');

        return view('tags',compact('tags'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {

        if($tag->is_active){
            return view('tag',compact('tag'));
        }

        return redirect()->route('404');

    }

}
