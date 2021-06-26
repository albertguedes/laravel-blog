<?php

namespace App\Http\Controllers;

use App\Models\Post;

class SitemapController extends Controller
{

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $posts = Post::where('published',true)->orderBy('created_at','DESC')->get();
        return response()->view('sitemap',compact('posts'))->header('Content-Type','text/xml');
    }

}
