<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'citizen_id' => $this->citizen_id,
            'stall_id' => $this->stall_id,
            'description' => $this->description,
            'status' => $this->status,
            'citizen' => UserResource::make($this->whenLoaded('citizen')),
            'stall' => FoodStallResource::make($this->whenLoaded('stall')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

