<?php

namespace App\Http\Requests\Admin\Tags;

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

        $tag = $this->request->get('tag');

        $rules = [ 
             "tag.parent_id"   => "required|integer",
             "tag.is_active"   => "required|boolean",
             "tag.title"       => "required|string|min:4|max:255|unique:\App\Models\Post,title,".$tag['id'],
             "tag.slug"        => "required|string|min:4|max:255|unique:\App\Models\Post,slug,".$tag['id'],
             "tag.description" => "required|string|min:5|max:255",
        ];
 
        return $rules;

    }

}
