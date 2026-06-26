<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user')?->id;

        return [
            'name' => ['sometimes', 'required', 'string', 'max:120'],
            'email' => ['sometimes', 'required', 'email', 'max:150', Rule::unique('users', 'email')->ignore($userId)],
            'password' => ['nullable', 'string', 'min:8'],
            'role' => ['sometimes', 'required', Rule::in([User::ROLE_ADMIN, User::ROLE_VENDOR, User::ROLE_CITIZEN])],
        ];
    }
}

