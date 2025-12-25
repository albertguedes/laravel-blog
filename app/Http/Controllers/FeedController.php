<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Response;

use App\Models\Post;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke (): Response
    {
        $posts = Post::where('published',true)
                        ->orderBy('updated_at','desc')
                        ->limit(50)
                        ->get();

        return response()->view('rss',compact('posts'))
                        ->header('Content-Type', 'application/xml');
    }
}
