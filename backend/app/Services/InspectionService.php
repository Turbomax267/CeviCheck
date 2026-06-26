<?php

namespace App\Services;

use App\Models\FoodStall;
use App\Models\Inspection;
use App\Repositories\Contracts\InspectionRepositoryInterface;

class InspectionService
{
    public function __construct(private readonly InspectionRepositoryInterface $inspectionRepository)
    {
    }

    public function paginate(int $perPage = 15)
    {
        return $this->inspectionRepository->paginate($perPage);
    }

    public function store(array $data): Inspection
    {
        $inspection = $this->inspectionRepository->create($data);

        FoodStall::query()->whereKey($inspection->stall_id)->update(['sanitary_status' => $inspection->sanitary_status]);

        return $inspection->load(['stall.vendor', 'inspector']);
    }

    public function update(Inspection $inspection, array $data): Inspection
    {
        $updated = $this->inspectionRepository->update($inspection, $data);

        FoodStall::query()->whereKey($updated->stall_id)->update(['sanitary_status' => $updated->sanitary_status]);

        return $updated;
    }

    public function destroy(Inspection $inspection): void
    {
        $this->inspectionRepository->delete($inspection);
    }
}

