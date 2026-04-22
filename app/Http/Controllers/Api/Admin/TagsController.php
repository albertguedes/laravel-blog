<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Admin\Tags\StoreTagRequest;
use App\Http\Requests\Admin\Tags\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

/**
 * Controller for admin tag management.
 *
 * Handles CRUD operations for tags with soft delete functionality.
 */
class TagsController extends ApiController
{
    /**
     * Display a paginated listing of tags.
     */
    public function index(): JsonResponse
    {
        $tags = Tag::orderBy('title', 'asc')
            ->paginate(15);

        return $this->paginated($tags);
    }

    /**
     * Store a newly created tag.
     *
     * Auto-generates slug from title if not provided.
     */
    public function store(StoreTagRequest $request): JsonResponse
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $tag = Tag::create($validated);

        return $this->created($tag);
    }

    /**
     * Display the specified tag with its posts.
     */
    public function show(Tag $tag): JsonResponse
    {
        $tag->load('posts');

        return $this->success($tag);
    }

    /**
     * Update the specified tag.
     *
     * Auto-regenerates slug from title if slug is empty.
     */
    public function update(UpdateTagRequest $request, Tag $tag): JsonResponse
    {
        $validated = $request->validated();

        if (isset($validated['slug']) && empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $tag->fill($validated);
        $tag->save();

        return $this->updated($tag);
    }

    /**
     * Soft delete the specified tag.
     */
    public function destroy(Tag $tag): JsonResponse
    {
        $tag->delete();

        return $this->deleted();
    }
}
