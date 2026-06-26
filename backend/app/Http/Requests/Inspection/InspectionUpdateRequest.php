<?php

namespace App\Http\Requests\Inspection;

class InspectionUpdateRequest extends InspectionStoreRequest
{
    public function rules(): array
    {
        $rules = parent::rules();

        foreach ($rules as $field => $fieldRules) {
            array_unshift($rules[$field], 'sometimes');
        }

        return $rules;
    }
}

