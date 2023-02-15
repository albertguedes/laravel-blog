<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View as ViewView;

class PostsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {

        $posts = Post::Published()->select('slug','title','created_at','author_id','description')
                                  ->orderBy('created_at','DESC')
                                  ->paginate(5);

        $view = 'index';
        $data = compact('posts');

        return view($view,$data);

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

        if($post->published){
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

        $posts = Post::Published()->select('author_id','slug','title','created_at')
                                  ->orderBy('created_at','DESC')
                                  ->get();

        $archive = [];
        foreach( $posts as $post ){
            $year  = $post->created_at->format('Y');
            $month = $post->created_at->format('F');
            $day   = $post->created_at->format('d');
            $archive[$year][$month][$day][] = $post;
        }

        $view = 'archive';
        $data = compact('archive');

        return view($view,$data);

    }

}
