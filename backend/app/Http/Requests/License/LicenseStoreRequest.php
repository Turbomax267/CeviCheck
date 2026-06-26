<?php

namespace App\Http\Requests\License;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LicenseStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'stall_id' => ['required', 'exists:food_stalls,id'],
            'license_number' => ['required', 'string', 'max:50', 'unique:licenses,license_number'],
            'issue_date' => ['required', 'date'],
            'expiration_date' => ['required', 'date', 'after_or_equal:issue_date'],
            'status' => ['required', Rule::in(['vigente', 'vencida', 'suspendida'])],
        ];
    }
}

