<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\Tags;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:2|max:100|unique:tags,title',
            'slug' => 'nullable|string|min:2|max:100|unique:tags,slug',
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ];
    }
}
