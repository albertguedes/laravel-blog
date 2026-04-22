<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Response;

/**
 * Sitemap XML generator controller.
 *
 * Generates an XML sitemap of all published posts for search engine indexing.
 * Returns the 50 most recently created posts in XML format.
 */
class SitemapController extends Controller
{
    /**
     * Generate sitemap XML.
     *
     * @return Response XML response with Content-Type text/xml
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
