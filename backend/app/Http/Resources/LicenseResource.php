<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LicenseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'stall_id' => $this->stall_id,
            'license_number' => $this->license_number,
            'issue_date' => $this->issue_date?->toDateString(),
            'expiration_date' => $this->expiration_date?->toDateString(),
            'status' => $this->status,
            'stall' => FoodStallResource::make($this->whenLoaded('stall')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

