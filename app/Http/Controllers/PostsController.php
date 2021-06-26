<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::where('published',true)->orderBy('created_at','ASC')->paginate(5);

        return view('index',compact('posts'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show( Post $post )
    {
        if($post->published){
            return view('post',compact('post'));
        }

        return redirect()->route('404');
        
    }

}
