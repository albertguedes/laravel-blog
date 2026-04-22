<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\Categories;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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
