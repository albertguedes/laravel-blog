<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Admin\Categories\StoreCategoryRequest;
use App\Http\Requests\Admin\Categories\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

/**
 * Controller for admin category management.
 *
 * Handles CRUD operations for categories with adjacency list
 * hierarchy support and soft delete functionality.
 */
class CategoriesController extends ApiController
{
    /**
     * Display a paginated listing of categories.
     */
    public function index(): JsonResponse
    {
        $categories = Category::orderBy('title', 'asc')
            ->paginate(15);

        return $this->paginated($categories);
    }

    /**
     * Store a newly created category.
     *
     * Auto-generates slug from title if not provided.
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $category = Category::create($validated);

        return $this->created($category);
    }

    /**
     * Display the specified category with parent, children, and posts.
     */
    public function show(Category $category): JsonResponse
    {
        $category->load('parent', 'children', 'posts');

        return $this->success($category);
    }

    /**
     * Update the specified category.
     *
     * Auto-regenerates slug from title if slug is empty.
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $validated = $request->validated();

        if (isset($validated['slug']) && empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $category->fill($validated);
        $category->save();

        return $this->updated($category);
    }

    /**
     * Soft delete the specified category.
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return $this->deleted();
    }
}
