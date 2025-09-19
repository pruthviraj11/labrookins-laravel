<?php

namespace App\Http\Requests\ResetPassword;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ResetPasswordRequest extends FormRequest
{
    public function authorize()
    {
        // only authenticated users should reach here because of middleware('auth')
        return true;
    }

    public function rules()
    {
        return [
            'old_password' => ['required', 'string'],
            'password' => [
                'required',
                'string',
                'confirmed', // expects password_confirmation field
                Password::min(8), // adjust rules as needed
            ],
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'Please enter your old password.',
            'password.required' => 'Please enter a new password.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be at least 8 characters.',
        ];
    }
}
