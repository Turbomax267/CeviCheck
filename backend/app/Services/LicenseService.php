<?php

namespace App\Services;

use App\Models\FoodStall;
use App\Models\License;
use App\Repositories\Contracts\LicenseRepositoryInterface;

class LicenseService
{
    public function __construct(private readonly LicenseRepositoryInterface $licenseRepository)
    {
    }

    public function paginate(int $perPage = 15)
    {
        return $this->licenseRepository->paginate($perPage);
    }

    public function store(array $data): License
    {
        $license = $this->licenseRepository->create($data);

        FoodStall::query()->whereKey($license->stall_id)->update(['license_status' => $license->status]);

        return $license->load('stall.vendor');
    }

    public function update(License $license, array $data): License
    {
        $updated = $this->licenseRepository->update($license, $data);

        FoodStall::query()->whereKey($updated->stall_id)->update(['license_status' => $updated->status]);

        return $updated;
    }

    public function destroy(License $license): void
    {
        $stallId = $license->stall_id;
        $this->licenseRepository->delete($license);
        FoodStall::query()->whereKey($stallId)->update(['license_status' => FoodStall::LICENSE_SIN_LICENCIA]);
    }
}

