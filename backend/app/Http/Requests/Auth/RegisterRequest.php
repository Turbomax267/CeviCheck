<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in([User::ROLE_CITIZEN, User::ROLE_VENDOR])],
            'dni' => ['required_if:role,vendor', 'nullable', 'digits:8', 'unique:vendors,dni'],
            'phone' => ['required_if:role,vendor', 'nullable', 'string', 'max:20'],
        ];
    }
}

