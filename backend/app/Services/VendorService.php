<?php

namespace App\Services;

use App\Models\Vendor;
use App\Repositories\Contracts\VendorRepositoryInterface;

class VendorService
{
    public function __construct(private readonly VendorRepositoryInterface $vendorRepository)
    {
    }

    public function publicIndex(int $perPage = 12)
    {
        return $this->vendorRepository->paginatePublic($perPage);
    }

    public function show(Vendor $vendor): Vendor
    {
        return $this->vendorRepository->findDetailed($vendor);
    }

    public function store(array $data): Vendor
    {
        return $this->vendorRepository->create($data);
    }

    public function update(Vendor $vendor, array $data): Vendor
    {
        return $this->vendorRepository->update($vendor, $data);
    }

    public function destroy(Vendor $vendor): void
    {
        $this->vendorRepository->delete($vendor);
    }
}

