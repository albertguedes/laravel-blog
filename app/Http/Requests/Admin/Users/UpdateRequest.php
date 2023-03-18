<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

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
    public function rules( Request $request )
    {

        $user = $request->input('user');

        $rules = [
            "user.name"      => "required|string|min:4|max:255",
            "user.username"  => "required|string|min:5|max:255|unique:App\Models\User,username,".$user['id'],
            "user.email"     => "required|string|min:5|max:255|email:rfc|unique:App\Models\User,email,".$user['id'],
            "user.password"  => [
                'nullable',
                'sometimes',
                'string',
                'confirmed',
                Password::min(8)->letters()->numbers()->mixedCase()->uncompromised()
            ],
            "user.is_active" => "in:0,1"
        ];

        return $rules;

    }

}
