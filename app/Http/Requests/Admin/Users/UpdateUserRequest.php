<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\Users;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request validation for updating an existing user.
 */
class UpdateUserRequest extends FormRequest
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
        $userId = $this->route('user');

        return [
            'email' => 'sometimes|required|string|email:rfc|max:255|unique:users,email,'.$userId,
            'password' => 'sometimes|nullable|string|min:8|max:255',
            'name' => 'sometimes|required|string|min:4|max:255',
            'username' => 'sometimes|required|string|min:4|max:255|unique:profiles,username,'.$userId.',user_id',
            'about' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
            'is_admin' => 'boolean',
        ];
    }
}
