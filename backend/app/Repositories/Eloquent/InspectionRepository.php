<?php

namespace App\Repositories\Eloquent;

use App\Models\Inspection;
use App\Repositories\Contracts\InspectionRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InspectionRepository implements InspectionRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Inspection::query()->with(['stall.vendor', 'inspector'])->latest()->paginate($perPage);
    }

    public function create(array $data): Inspection
    {
        return Inspection::query()->create($data);
    }

    public function update(Inspection $inspection, array $data): Inspection
    {
        $inspection->update($data);

        return $inspection->refresh()->load(['stall.vendor', 'inspector']);
    }

    public function delete(Inspection $inspection): void
    {
        $inspection->delete();
    }
}

