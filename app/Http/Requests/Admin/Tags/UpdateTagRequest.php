<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\Tags;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request validation for updating an existing tag.
 */
class UpdateTagRequest extends FormRequest
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
        $tagId = $this->route('tag');

        return [
            'title' => 'sometimes|required|string|min:2|max:100|unique:tags,title,'.$tagId,
            'slug' => 'sometimes|nullable|string|min:2|max:100|unique:tags,slug,'.$tagId,
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ];
    }
}
