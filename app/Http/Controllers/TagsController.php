<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;

use App\Models\Tag;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $tags = Tag::select('id','slug','title')
                    ->where('is_active',true)
                    ->orderBy('title','ASC')
                    ->get();

        return View('tags.index',compact('tags'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag $tag
     * @return \Illuminate\View\View
     */
    public function show(Tag $tag)
    {
        if (!$tag || !$tag->is_active) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return view('tags.show',compact('tag'));
    }
}
