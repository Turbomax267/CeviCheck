<?php

namespace App\Repositories\Eloquent;

use App\Models\License;
use App\Repositories\Contracts\LicenseRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class LicenseRepository implements LicenseRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return License::query()->with('stall.vendor')->latest()->paginate($perPage);
    }

    public function create(array $data): License
    {
        return License::query()->create($data);
    }

    public function update(License $license, array $data): License
    {
        $license->update($data);

        return $license->refresh()->load('stall.vendor');
    }

    public function delete(License $license): void
    {
        $license->delete();
    }
}

