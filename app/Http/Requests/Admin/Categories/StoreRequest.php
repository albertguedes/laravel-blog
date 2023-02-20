<?php

namespace App\Http\Requests\Admin\Categories;

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
            "category.parent_id"   => "nullable|integer|exists:categories,id",
            "category.title"       => "required|string|min:4|max:255|unique:\App\Models\Category,title",
            "category.slug"        => "required|string|min:4|max:255|unique:\App\Models\Category,slug",
            "category.description" => "required|string|min:5|max:255",
            "category.is_active"   => "in:0,1"
        ];

        return $rules;

    }

}
