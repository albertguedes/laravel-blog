<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Admin\Categories\StoreCategoryRequest;
use App\Http\Requests\Admin\Categories\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class CategoriesController extends ApiController
{
    public function index(): JsonResponse
    {
        $categories = Category::orderBy('title', 'asc')
            ->paginate(15);

        return $this->paginated($categories);
    }

    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $category = Category::create($validated);

        return $this->created($category);
    }

    public function show(Category $category): JsonResponse
    {
        $category->load('parent', 'children', 'posts');

        return $this->success($category);
    }

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

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return $this->deleted();
    }
}
