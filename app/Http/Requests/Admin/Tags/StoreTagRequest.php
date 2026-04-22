<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\Tags;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request validation for creating a new tag.
 */
class StoreTagRequest extends FormRequest
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
            'title' => 'required|string|min:2|max:100|unique:tags,title',
            'slug' => 'nullable|string|min:2|max:100|unique:tags,slug',
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ];
    }
}
