<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'is_private' => 'sometimes',
            'name' => 'sometimes|string',
            'username' => 'sometimes|alpha_dash|unique:users,username,' . auth()->id(),
            'bio' => 'sometimes|nullable|string|max:500',
            'profile_image' => 'sometimes|image',
            'old_password' => 'sometimes|string',
            'password' => ['required_with:old_password', 'confirmed', 'string', Password::default()],
        ];
    }
}
