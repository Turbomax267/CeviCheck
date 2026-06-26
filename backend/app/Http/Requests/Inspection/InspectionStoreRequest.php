<?php

namespace App\Http\Requests\Inspection;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InspectionStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'stall_id' => ['required', 'exists:food_stalls,id'],
            'inspection_date' => ['required', 'date'],
            'observations' => ['nullable', 'string'],
            'sanitary_status' => ['required', Rule::in(['apto', 'pendiente', 'no_apto'])],
            'inspected_by' => ['required', 'exists:users,id'],
        ];
    }
}

