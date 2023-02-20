<?php

namespace App\Http\Requests\Admin\Posts;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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

       $post = $this->request->get('post');

       $rules = [
            "post.author_id"   => "required|integer",
            "post.category_id" => "nullable|integer|exists:categories,id",
            "post.tags"        => "nullable|array",
            "post.tags.*"      => "nullable|integer|exists:tags,id",
            "post.title"       => "required|string|min:4|max:255|unique:\App\Models\Post,title,".$post['id'],
            "post.slug"        => "required|string|min:4|max:255|unique:\App\Models\Post,slug,".$post['id'],
            "post.description" => "required|string|min:5|max:255",
            "post.content"     => "required|string|min:5",
            "post.published"   => "in:0,1"
        ];

        return $rules;

    }
}
