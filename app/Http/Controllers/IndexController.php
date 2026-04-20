<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $posts = Post::where('published', true)
            ->orderBy('updated_at', 'DESC')
            ->paginate(9);

        return view('index', compact('posts'));
    }

    /**
     * Show the specified post.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function post(Post $post): View
    {
        return view('post', compact('post'));
    }

    /**
     * Returns the about page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function about(): View
    {
        return View('about');
    }
}
