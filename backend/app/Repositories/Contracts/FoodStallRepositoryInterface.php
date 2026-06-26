<?php

namespace App\Repositories\Contracts;

use App\Models\FoodStall;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface FoodStallRepositoryInterface
{
    public function paginateDetailed(int $perPage = 15): LengthAwarePaginator;

    public function findDetailed(FoodStall $foodStall): FoodStall;

    public function create(array $data): FoodStall;

    public function update(FoodStall $foodStall, array $data): FoodStall;

    public function delete(FoodStall $foodStall): void;
}

