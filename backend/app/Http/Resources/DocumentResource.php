<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class DocumentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'stall_id' => $this->stall_id,
            'document_type' => $this->document_type,
            'file_path' => $this->file_path,
            'file_url' => Storage::disk('public')->url($this->file_path),
            'uploaded_at' => $this->uploaded_at,
            'stall' => FoodStallResource::make($this->whenLoaded('stall')),
        ];
    }
}

