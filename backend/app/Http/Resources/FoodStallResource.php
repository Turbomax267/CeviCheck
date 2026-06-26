<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodStallResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'vendor_id' => $this->vendor_id,
            'stall_name' => $this->stall_name,
            'district' => $this->district,
            'address' => $this->address,
            'license_status' => $this->license_status,
            'sanitary_status' => $this->sanitary_status,
            'vendor' => VendorResource::make($this->whenLoaded('vendor')),
            'licenses' => LicenseResource::collection($this->whenLoaded('licenses')),
            'inspections' => InspectionResource::collection($this->whenLoaded('inspections')),
            'documents' => DocumentResource::collection($this->whenLoaded('documents')),
            'reports' => ReportResource::collection($this->whenLoaded('reports')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

