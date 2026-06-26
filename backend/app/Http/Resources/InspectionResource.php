<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InspectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'stall_id' => $this->stall_id,
            'inspection_date' => $this->inspection_date?->toDateString(),
            'observations' => $this->observations,
            'sanitary_status' => $this->sanitary_status,
            'inspected_by' => $this->inspected_by,
            'stall' => FoodStallResource::make($this->whenLoaded('stall')),
            'inspector' => UserResource::make($this->whenLoaded('inspector')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

