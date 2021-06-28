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

        $posts = Post::where('published',true)->select('slug','title','created_at','author_id','description')->orderBy('created_at','DESC')->paginate(5);

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

    public function archive(){

        $posts = Post::where('published',true)->select('author_id','slug','title','created_at')->orderBy('created_at','DESC')->get();

        $archive = [];
        foreach( $posts as $post ){
            $year  = $post->created_at->format('Y');
            $month = $post->created_at->format('F');
            $day   = $post->created_at->format('d');
            $archive[$year][$month][$day][]=$post;
        }

        return view('archive',compact('archive'));

    }

}
