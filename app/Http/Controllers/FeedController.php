<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Response;

/**
 * RSS feed controller.
 *
 * Generates an RSS 2.0 XML feed of the latest published posts.
 * Returns the 50 most recently updated posts in RSS format.
 */
class FeedController extends Controller
{
    /**
     * Generate RSS feed.
     *
     * Retrieves up to 50 published posts ordered by update date
     * and returns them as an XML RSS feed.
     *
     * @return Response XML response with Content-Type application/xml
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
