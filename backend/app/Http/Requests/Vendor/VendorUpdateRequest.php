<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VendorUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $vendorId = $this->route('vendor')?->id;

        return [
            'user_id' => ['sometimes', 'required', 'exists:users,id'],
            'dni' => ['sometimes', 'required', 'digits:8', Rule::unique('vendors', 'dni')->ignore($vendorId)],
            'full_name' => ['sometimes', 'required', 'string', 'max:120'],
            'phone' => ['sometimes', 'required', 'string', 'max:20'],
        ];
    }
}

