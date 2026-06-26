<?php

namespace App\Http\Requests\Report;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReportUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => ['sometimes', 'required', 'string', 'min:10'],
            'status' => ['sometimes', 'required', Rule::in(['pendiente', 'en_proceso', 'resuelto', 'rechazado'])],
        ];
    }
}

