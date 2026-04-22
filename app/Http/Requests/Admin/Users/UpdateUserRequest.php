<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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
