<?php

declare(strict_types=1);

namespace App\Http\Requests\Profile\Posts;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for post update validation.
 */
class UpdateRequest extends FormRequest
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
        return [
            'id' => 'required|exists:posts,id',
            'author_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|min:4|max:255|unique:posts,title,'.$this->id,
            'slug' => [
                'nullable',
                'string',
                'min:4',
                'max:255',
                'unique:posts,slug,'.$this->id,
            ],
            'description' => 'required|string|min:4',
            'content' => 'required|string|min:4',
            'published' => ['nullable', 'boolean'],
            'tags' => ['array'],
            'tags.*' => ['integer', 'exists:tags,id'],
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
