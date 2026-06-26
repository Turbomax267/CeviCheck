<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class VendorStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'dni' => ['required', 'digits:8', 'unique:vendors,dni'],
            'full_name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:20'],
        ];
    }
}

