<?php declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|string|min:5|max:255|email:rfc|unique:users,email',
            'password' => 'required|string|min:8|max:255|confirmed',
            'name' => 'required|string|min:4|max:255',
            'username' => 'required|string|min:4|max:255|unique:profiles,username',
            'about' => 'string',
        ];
    }
}
