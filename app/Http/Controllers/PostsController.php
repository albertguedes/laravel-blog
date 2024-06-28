<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class PostsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\View\View
     */
    public function show( Post $post ): View
    {

        $view = 'errors.404';
        $data = [];

        if( $post && $post->published ){
            $view = 'post';
            $data = compact('post');
        }

        return view($view,$data);

    }

    /**
     * Undocumented function
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function archive(): View {
        return view('archive');
    }

}
