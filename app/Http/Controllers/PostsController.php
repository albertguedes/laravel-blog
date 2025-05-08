<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

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
     * @return \Illuminate\Contracts\View\View|Response
     */
    public function show (Post $post): View|Response
    {
        if (!$post->exists() || !$post->published) {
            return response('errors.404', Response::HTTP_NOT_FOUND);
        }

        return view('post',compact('post'));
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
