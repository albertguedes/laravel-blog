<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Http\Requests\Profile\Posts\StoreRequest;
use App\Http\Requests\Profile\Posts\UpdateRequest;
use App\Models\Post;

class PostsController extends Controller
{
    public function index(): View
    {
        $posts = Post::where('author_id', auth()->user()->id)
                        ->orderBy('title','ASC')
                        ->paginate(9);

        return view('profile.posts.index', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\View\View
     */
    public function show (Post $post): View
    {
        if ($post->author_id !== auth()->user()->id) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return view('profile.posts.show',compact('post'));
    }

    public function create(): View
    {
        return view('profile.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        $post = Post::create($validated);
        $post->save();

        return redirect()->route('post', $post)
                        ->with([ 'success' => 'Post created successfully' ]);
    }

    public function edit(Post $post): View
    {
        if ($post->author_id !== auth()->user()->id) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return view('profile.posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\posts  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Post $post)
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

    public function delete(Post $post): View
    {
        if ($post->author_id !== auth()->user()->id) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return view('profile.posts.delete',compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\posts  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post): RedirectResponse
    {
        if ($post->author_id !== auth()->user()->id) {
            return redirect()->route('profile.posts')
                            ->with('danger','You don\'t have permission to delete this post.');
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
                            ->with('danger','Wasn\'t possible to delete post. Try again later or contact support.');
        }

        return redirect()->route('profile.posts')->with([
            'success' => 'Post deleted successfully',
        ]);
    }
}
