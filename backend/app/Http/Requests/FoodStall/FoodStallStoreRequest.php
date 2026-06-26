<?php

namespace App\Http\Requests\FoodStall;

use App\Models\FoodStall;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FoodStallStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'vendor_id' => ['required', 'exists:vendors,id'],
            'stall_name' => ['required', 'string', 'max:120'],
            'district' => ['required', 'string', 'max:80'],
            'address' => ['required', 'string', 'max:200'],
            'license_status' => ['required', Rule::in([
                FoodStall::LICENSE_VIGENTE,
                FoodStall::LICENSE_VENCIDA,
                FoodStall::LICENSE_SUSPENDIDA,
                FoodStall::LICENSE_SIN_LICENCIA,
            ])],
            'sanitary_status' => ['required', Rule::in([
                FoodStall::SANITARY_APTO,
                FoodStall::SANITARY_PENDIENTE,
                FoodStall::SANITARY_NO_APTO,
            ])],
        ];
    }
}

