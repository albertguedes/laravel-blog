<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Admin\Posts\StorePostRequest;
use App\Http\Requests\Admin\Posts\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

/**
 * Controller for admin post management.
 *
 * Handles CRUD operations for posts including tag synchronization
 * and soft delete functionality.
 */
class PostsController extends ApiController
{
    /**
     * Display a paginated listing of posts.
     *
     * Includes author profile, category, and tags relationships.
     */
    public function index(): JsonResponse
    {
        $posts = Post::with('author.profile', 'category', 'tags')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return $this->paginated($posts);
    }

    /**
     * Store a newly created post.
     *
     * Auto-generates slug from title if not provided.
     * Syncs tags if provided.
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $post = Post::create($validated);

        if (! empty($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        }

        $post->load('author.profile', 'category', 'tags');

        return $this->created($post);
    }

    /**
     * Display the specified post with author, category, and tags.
     */
    public function show(Post $post): JsonResponse
    {
        $post->load('author.profile', 'category', 'tags');

        return $this->success($post);
    }

    /**
     * Update the specified post.
     *
     * Auto-regenerates slug from title if slug is empty.
     * Syncs tags if provided.
     */
    public function update(UpdatePostRequest $request, Post $post): JsonResponse
    {
        $validated = $request->validated();

        if (isset($validated['slug']) && empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $post->fill($validated);
        $post->save();

        if (isset($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        }

        $post->load('author.profile', 'category', 'tags');

        return $this->updated($post);
    }

    /**
     * Soft delete the specified post.
     *
     * Detaches all associated tags before deletion.
     */
    public function destroy(Post $post): JsonResponse
    {
        $post->tags()->detach();
        $post->delete();

        return $this->deleted();
    }
}
