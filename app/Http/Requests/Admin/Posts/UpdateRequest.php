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
            "post.slug"        => "required|string|min:4|max:255|unique:\App\Models\Post,slug,".$post['id'],            
            "post.title"       => "required|string|min:4|max:255|unique:\App\Models\Post,title,".$post['id'], 
            "user.description" => "required|string|min:5|max:255",
            "user.content"     => "required|string|min:5",
            "user.published"   => "required|boolean"
        ];

        return $rules;

    }
}
