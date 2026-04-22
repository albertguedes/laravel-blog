<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\Posts;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request validation for updating an existing post.
 */
class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
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

    /**
     * Prepare the data for validation.
     */
    public function prepareForValidation(): void
    {
        $this->merge([
            'published' => $this->has('published'),
        ]);
    }
}
