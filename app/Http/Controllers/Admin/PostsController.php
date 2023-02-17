<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Posts\StoreRequest;
use App\Http\Requests\Admin\Posts\UpdateRequest;
use App\Models\Category;
use App\Models\Post;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostsController extends Controller
{

    /**
     * Get the routes for tabs.
     *
     * @param Post $post
     * @return array
     */
    protected function getRoutes( Post $post ): array {
        return [
            [
                'url' => route('posts.show',compact('post')),
                'name' => 'Show'
            ],
            [
                'url' => route('posts.edit',compact('post')),
                'name' => 'Edit'
            ],
            [
                'url' => route('posts.delete',compact('post')),
                'name' => 'Delete'
            ],
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $posts = Post::orderBy('id','ASC')->paginate(10);

        return view('admin.posts.index',compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Posts\StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store( StoreRequest $request ): RedirectResponse
    {

        $validated = $request->validated();

        $post = Post::create($validated['post']);

        // Add ( or not ) new tags.
        if (isset($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        }

        $post->save();

        $routes = $this->getRoutes($post);

        return redirect()->route('posts.show',compact('post','routes'));

    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\View\View
     */
    public function show( Post $post ): View
    {
        $routes = $this->getRoutes($post);
        return view('admin.posts.show',compact('post','routes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\View\View
     */
    public function edit( Post $post ): View
    {
        $routes = $this->getRoutes($post);
        return view('admin.posts.edit',compact('post','routes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Posts\UpdateRequest $request
     * @param  Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( UpdateRequest $request, Post $post ): RedirectResponse
    {

        $validated = $request->validated();

        $post->update($validated['post']);

        // Add ( or not ) new tags.
        $post->tags()->sync($validated['tags']);
        $post->save();

        $routes = $this->getRoutes($post);

        return redirect()->route('posts.show',compact('post','routes'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\View\View
     */
    public function delete( Post $post ): View
    {
        $routes = $this->getRoutes($post);
        return view('admin.posts.delete',compact('post','routes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy( Post $post ): RedirectResponse
    {
        $post->delete();
        return redirect()->route('posts.index');
    }

}
