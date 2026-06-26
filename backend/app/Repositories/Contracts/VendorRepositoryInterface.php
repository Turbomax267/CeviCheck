<?php

namespace App\Repositories\Contracts;

use App\Models\Vendor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface VendorRepositoryInterface
{
    public function paginatePublic(int $perPage = 12): LengthAwarePaginator;

    public function allDetailed(): Collection;

    public function findDetailed(Vendor $vendor): Vendor;

    public function create(array $data): Vendor;

    public function update(Vendor $vendor, array $data): Vendor;

    public function delete(Vendor $vendor): void;
}

