<?php

namespace App\Repositories\Eloquent;

use App\Models\FoodStall;
use App\Repositories\Contracts\FoodStallRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FoodStallRepository implements FoodStallRepositoryInterface
{
    public function paginateDetailed(int $perPage = 15): LengthAwarePaginator
    {
        return FoodStall::query()
            ->with(['vendor.user', 'licenses', 'inspections', 'documents'])
            ->latest()
            ->paginate($perPage);
    }

    public function findDetailed(FoodStall $foodStall): FoodStall
    {
        return $foodStall->load([
            'vendor.user',
            'licenses',
            'inspections.inspector',
            'documents',
            'reports.citizen',
        ]);
    }

    public function create(array $data): FoodStall
    {
        return FoodStall::query()->create($data);
    }

    public function update(FoodStall $foodStall, array $data): FoodStall
    {
        $foodStall->update($data);

        return $foodStall->refresh()->load(['vendor.user', 'licenses', 'inspections', 'documents']);
    }

    public function delete(FoodStall $foodStall): void
    {
        $foodStall->delete();
    }
}

