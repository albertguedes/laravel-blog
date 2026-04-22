<?php

declare(strict_types=1);

namespace App\Http\Requests\Contact;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for contact message validation.
 */
class MessageRequest extends FormRequest
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
            'name' => 'required|string|min:4|max:255',
            'email' => 'required|string|min:5|max:255|email:rfc',
            'subject' => 'required|string|min:4|max:255',
            'message' => 'required|string|min:4',
        ];
    }
}
