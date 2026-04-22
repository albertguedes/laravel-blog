<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\Tags;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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
