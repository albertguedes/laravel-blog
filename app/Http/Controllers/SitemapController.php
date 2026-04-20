<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     */
    public function __invoke(): Response
    {
        $posts = Post::where('published', true)
            ->orderBy('created_at', 'DESC')
            ->get();

        return response()->view('sitemap', compact('posts'))
            ->header('Content-Type', 'text/xml');
    }
}
