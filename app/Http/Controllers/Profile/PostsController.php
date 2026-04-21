<?php

declare(strict_types=1);

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\Posts\StoreRequest;
use App\Http\Requests\Profile\Posts\UpdateRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

/**
 * Controller for managing user posts in the profile section.
 *
 * @author Albert
 *
 * @since 1.0.0
 */
class PostsController extends Controller
{
    /**
     * Display a listing of the user's posts.
     */
    public function index(): View
    {
        $posts = Post::where('author_id', auth()->user()->id)
            ->orderBy('title', 'ASC')
            ->paginate(9);

        return view('profile.posts.index', compact('posts'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): View
    {
        if ($post->author_id !== auth()->user()->id) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return view('profile.posts.show', compact('post'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create(): View
    {
        return view('profile.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $post = Post::create($validated);
        $post->save();

        return redirect()->route('post', $post)
            ->with(['success' => 'Post created successfully']);
    }

    /**
     * Show the form for editing a post.
     */
    public function edit(Post $post): View
    {
        if ($post->author_id !== auth()->user()->id) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return view('profile.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Post $post): RedirectResponse
    {
        if ($post->author_id !== auth()->user()->id) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $validated = $request->validated();

        DB::transaction(function () use ($post, $validated) {
            $post->tags()->sync($validated['tags'] ?? []);
            $post->update($validated);
            $post->save();
        });

        return redirect()->route('profile.post', compact('post'))->with([
            'success' => 'Post updated successfully',
        ]);
    }

    /**
     * Show the confirmation page for deleting a post.
     */
    public function delete(Post $post): View
    {
        if ($post->author_id !== auth()->user()->id) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return view('profile.posts.delete', compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        if ($post->author_id !== auth()->user()->id) {
            return redirect()->route('profile.posts')
                ->with('danger', 'You don\'t have permission to delete this post.');
        }

        $post_id = $post->id;

        DB::transaction(function () use ($post) {
            $post->tags()->detach();
            $post->category()->dissociate();
            $post->save();

            $post->delete();
        });

        if (Post::whereKey($post_id)->exists()) {
            return redirect()->route('profile.posts')
                ->with('danger', 'Wasn\'t possible to delete post. Try again later or contact support.');
        }

        return redirect()->route('profile.posts')->with([
            'success' => 'Post deleted successfully',
        ]);
    }
}
