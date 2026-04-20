<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\View\View;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tags = Tag::select('id', 'slug', 'title')
            ->where('is_active', true)
            ->orderBy('title', 'ASC')
            ->get();

        return View('tags.index', compact('tags'));
    }

    /**
     * Display the specified resource.
     *
     * @return View
     */
    public function show(Tag $tag)
    {
        if (! $tag || ! $tag->is_active) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return view('tags.show', compact('tag'));
    }
}
