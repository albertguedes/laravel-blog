<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\Users;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request validation for creating a new user.
 */
class StoreUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email:rfc|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:255',
            'name' => 'required|string|min:4|max:255',
            'username' => 'required|string|min:4|max:255|unique:profiles,username',
            'about' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
            'is_admin' => 'boolean',
        ];
    }
}
