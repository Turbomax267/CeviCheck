<?php

namespace App\Http\Requests\Report;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReportStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'citizen_id' => ['nullable', 'exists:users,id'],
            'stall_id' => ['required', 'exists:food_stalls,id'],
            'description' => ['required', 'string', 'min:10'],
            'status' => ['nullable', Rule::in(['pendiente', 'en_proceso', 'resuelto', 'rechazado'])],
        ];
    }
}

