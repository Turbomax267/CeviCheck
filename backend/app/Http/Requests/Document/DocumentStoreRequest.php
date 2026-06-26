<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DocumentStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'stall_id' => ['required', 'exists:food_stalls,id'],
            'document_type' => ['required', Rule::in(['licencia', 'foto', 'inspeccion', 'otro'])],
            'file' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ];
    }
}

