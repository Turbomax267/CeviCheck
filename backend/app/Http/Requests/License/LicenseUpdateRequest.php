<?php

namespace App\Http\Requests\License;

use Illuminate\Validation\Rule;

class LicenseUpdateRequest extends LicenseStoreRequest
{
    public function rules(): array
    {
        $licenseId = $this->route('license')?->id;

        return [
            'stall_id' => ['sometimes', 'required', 'exists:food_stalls,id'],
            'license_number' => ['sometimes', 'required', 'string', 'max:50', Rule::unique('licenses', 'license_number')->ignore($licenseId)],
            'issue_date' => ['sometimes', 'required', 'date'],
            'expiration_date' => ['sometimes', 'required', 'date', 'after_or_equal:issue_date'],
            'status' => ['sometimes', 'required', Rule::in(['vigente', 'vencida', 'suspendida'])],
        ];
    }
}

