<?php declare(strict_types=1);

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the profile is authorized to make this request.
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
    public function rules (Request $request)
    {
        return [
            "email" => "required|string|min:5|max:255|email:rfc|unique:users,email,".$request->user()->id,
            "name" => "required|string|min:4|max:255",
            "username" => "required|string|min:4|max:255|unique:profiles,username,".$request->user()->profile->id,
            "about" => "string",
        ];
    }
}
