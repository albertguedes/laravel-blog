<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;
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
    public function rules()
    {

        $user = $this->request->get('user');

        $rules = [ 
            "user.name"      => "required|string|min:4|max:255", 
            "user.username"  => "required|string|min:5|max:255|unique:App\Models\User,username,".$user['id'],
            "user.email"     => "required|string|min:5|max:255|email:rfc|unique:App\Models\User,email,".$user['id'],
            "user.is_active" => "required|boolean"
        ];

        if( !empty( $user['password'] ) ) {
            $rules['user.password'] = [ 
                'sometimes',
                'string',
                'confirmed',
                Password::min(8)->letters()->numbers()->mixedCase()->uncompromised()
            ];
        }

        return $rules;

    }
}
