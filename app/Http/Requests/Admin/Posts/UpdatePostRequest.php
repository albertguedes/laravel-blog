<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\Posts;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $postId = $this->route('post');

        return [
            'author_id' => 'sometimes|required|integer|exists:users,id',
            'category_id' => 'nullable|integer|exists:categories,id',
            'title' => 'sometimes|required|string|min:4|max:255|unique:posts,title,'.$postId,
            'slug' => 'sometimes|nullable|string|min:4|max:255|unique:posts,slug,'.$postId,
            'description' => 'sometimes|required|string|min:4',
            'content' => 'sometimes|required|string|min:4',
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
