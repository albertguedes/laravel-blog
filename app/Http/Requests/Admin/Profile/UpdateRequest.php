<?php

namespace App\Http\Requests\Admin\Profile;

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

        $profile = $this->request->get('profile');

        $rules = [ 
            "profile.name"  => "required|string|min:4|max:255", 
            "profile.email" => "required|string|min:5|max:255|email:rfc|unique:App\Models\User,email,".$profile['id'],
        ];

        if( !empty( $profile['password'] ) ){
            $rules['profile.password'] = [ 
                'sometimes',
                'string',
                'confirmed',
                Password::min(8)->letters()->numbers()->mixedCase()->uncompromised()
            ];
        }

        return $rules;

    }
}
