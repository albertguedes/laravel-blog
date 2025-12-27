<?php declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\User;

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
            'email' => [
                'required',
                'string',
                'min:5',
                'max:255',
                'email:rfc',
                function ($attribute, $value, $fail) {
                    $user = User::where('email', $value)->where('is_active', true)->first();
                    if (is_null($user)) {
                        $fail('The ' . $attribute . ' does not exist.');
                    }
                },
            ],
            'token' => [
                'nullable',
                'string',
                'min:10',
                'max:10',
            ]
        ];
    }
}
