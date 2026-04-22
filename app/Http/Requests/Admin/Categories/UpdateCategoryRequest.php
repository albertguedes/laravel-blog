<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\Categories;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request validation for updating an existing category.
 */
class UpdateCategoryRequest extends FormRequest
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
        $categoryId = $this->route('category');

        return [
            'parent_id' => 'nullable|integer|exists:categories,id',
            'title' => 'sometimes|required|string|min:2|max:100|unique:categories,title,'.$categoryId,
            'slug' => 'sometimes|nullable|string|min:2|max:100|unique:categories,slug,'.$categoryId,
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ];
    }
}
