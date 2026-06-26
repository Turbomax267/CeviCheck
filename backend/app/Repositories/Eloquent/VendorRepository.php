<?php

namespace App\Repositories\Eloquent;

use App\Models\Vendor;
use App\Repositories\Contracts\VendorRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class VendorRepository implements VendorRepositoryInterface
{
    public function paginatePublic(int $perPage = 12): LengthAwarePaginator
    {
        return Vendor::query()
            ->with(['user', 'foodStalls'])
            ->latest()
            ->paginate($perPage);
    }

    public function allDetailed(): Collection
    {
        return Vendor::query()->with(['user', 'foodStalls'])->latest()->get();
    }

    public function findDetailed(Vendor $vendor): Vendor
    {
        return $vendor->load([
            'user',
            'foodStalls.licenses',
            'foodStalls.inspections.inspector',
            'foodStalls.documents',
            'foodStalls.reports',
        ]);
    }

    public function create(array $data): Vendor
    {
        return Vendor::query()->create($data);
    }

    public function update(Vendor $vendor, array $data): Vendor
    {
        $vendor->update($data);

        return $vendor->refresh()->load(['user', 'foodStalls']);
    }

    public function delete(Vendor $vendor): void
    {
        $vendor->delete();
    }
}

