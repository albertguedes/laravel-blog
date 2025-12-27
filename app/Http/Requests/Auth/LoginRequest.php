<?php declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\User;

class LoginRequest extends FormRequest
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
            'email' => "required|string|min:5|max:255|email:rfc",
            'password' => ['required', 'string'],
            'remember' => ['boolean'],
        ];
    }

    /**
     * Adds a custom validation rule to check if the user is active.
     *
     * If the user is not active, an error message will be added to the
     * validator's errors bag.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator)
        {
            $user = User::where('email', $this->email)->first();

            if ($user && !$user->is_active) {
                $validator->errors()->add(
                    'email',
                    'This account does exist.'
                );
            }
        });
    }
}
