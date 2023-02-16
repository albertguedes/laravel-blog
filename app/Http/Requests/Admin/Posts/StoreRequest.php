<?php

namespace App\Http\Requests\Admin\Posts;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = [
            "post.author_id"   => "required|integer",
            "post.published"   => "required|boolean",
            "post.title"       => "required|string|min:4|max:255|unique:\App\Models\Post,title",
            "post.slug"        => "required|string|min:4|max:255|unique:\App\Models\Post,slug",
            "post.description" => "required|string|min:5|max:255",
            "post.content"     => "required|string|min:5",
            "post.category_id" => "required|integer|exists:categories,id",
            "post.tags"        => "array",
            "post.tags.*"      => "integer|exists:tags,id"
        ];

        return $rules;

    }
}
