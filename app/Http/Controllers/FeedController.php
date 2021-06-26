<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class FeedController extends Controller
{

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke( Request $request )
    {
        $posts = Post::where('published',true)->orderBy('created_at','desc')->limit(50)->get();
        return response()->view('rss',compact('posts'))->header('Content-Type', 'application/xml');
    }

}