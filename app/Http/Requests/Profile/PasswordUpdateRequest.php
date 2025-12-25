<?php declare(strict_types=1);

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class PasswordUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'password' => [
                'sometimes',
                'string',
                'confirmed',
            ],
        ];
    }

    /**
     * Get the error messages for the defined rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'password.required_with' => 'The :attribute is required when :other is present.',
        ];
    }
}
