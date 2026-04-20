<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Response;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): Response
    {
        $posts = Post::where('published', true)
            ->orderBy('updated_at', 'desc')
            ->limit(50)
            ->get();

        return response()->view('rss', compact('posts'))
            ->header('Content-Type', 'application/xml');
    }
}
