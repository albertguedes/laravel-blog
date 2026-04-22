<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\Roles;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $roleId = $this->route('role');

        return [
            'title' => 'sometimes|required|string|min:3|max:50|unique:roles,title,'.$roleId,
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ];
    }
}
