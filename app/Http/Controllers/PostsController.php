<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Post;

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
    public function show (Post $post): View
    {
        if (!$post->exists() || !$post->published) {
            return view('errors.404', Response::HTTP_NOT_FOUND, );
        }

        return view('post',compact('post'));
    }

    /**
     * Undocumented function
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function archive(Request $request): View
    {
        if ($request->get('month') && !$request->get('year')) {
            return view('404');
        }

        if ($request->get('day') && !$request->get('month') || $request->get('day') && !$request->get('year')) {
            return view('404');
        }

        $year = 0;
        $month = 0;
        $day = 0;

        if ($request->get('year')) {
            $year = $request->get('year');
            if ($request->get('month')) {
                $month = $request->get('month');
                if ($request->get('day')) {
                    $day = $request->get('day');
                }
            }
        }

        return view('archive', compact('year','month','day'));
    }
}
