<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\Categories;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'parent_id' => 'nullable|integer|exists:categories,id',
            'title' => 'required|string|min:2|max:100|unique:categories,title',
            'slug' => 'nullable|string|min:2|max:100|unique:categories,slug',
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ];
    }
}
