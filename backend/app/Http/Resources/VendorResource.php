<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'dni' => $this->dni,
            'full_name' => $this->full_name,
            'phone' => $this->phone,
            'user' => UserResource::make($this->whenLoaded('user')),
            'food_stalls' => FoodStallResource::collection($this->whenLoaded('foodStalls')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

