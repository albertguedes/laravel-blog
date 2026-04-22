<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\Posts;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'author_id' => 'required|integer|exists:users,id',
            'category_id' => 'nullable|integer|exists:categories,id',
            'title' => 'required|string|min:4|max:255|unique:posts,title',
            'slug' => 'nullable|string|min:4|max:255|unique:posts,slug',
            'description' => 'required|string|min:4',
            'content' => 'required|string|min:4',
            'published' => 'boolean',
            'tags' => 'array',
            'tags.*' => 'integer|exists:tags,id',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'published' => $this->has('published'),
        ]);
    }
}
