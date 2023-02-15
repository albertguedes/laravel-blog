<?php

namespace App\Http\Requests\Admin\Tags;

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
            "tag.is_active"   => "required|boolean",
            "tag.title"       => "required|string|min:4|max:255|unique:\App\Models\Tag,title",
            "tag.slug"        => "required|string|min:4|max:255|unique:\App\Models\Tag,slug",
            "tag.description" => "required|string|min:5|max:255",
        ];

        return $rules;

    }

}
