<?php declare(strict_types=1);

namespace App\Http\Requests\Profile\Posts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'author_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|min:4|max:255|unique:posts,title',
            'slug' =>[
                'nullable',
                'string',
                'min:4',
                'max:255',
                'unique:posts,slug',
            ],
            'description' => 'required|string|min:4',
            'content' => 'required|string|min:4',
            'published' => [ 'nullable', 'boolean' ], //'boolean',
            'tags'   => ['array'],
            'tags.*' => ['integer', 'exists:tags,id'],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'published' => $this->has('published')
        ]);
    }
}
