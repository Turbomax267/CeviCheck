<?php

namespace App\Http\Requests\FoodStall;

class FoodStallUpdateRequest extends FoodStallStoreRequest
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

