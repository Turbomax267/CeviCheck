<?php

namespace App\Services;

use App\Models\FoodStall;
use App\Repositories\Contracts\FoodStallRepositoryInterface;

class FoodStallService
{
    public function __construct(private readonly FoodStallRepositoryInterface $foodStallRepository)
    {
    }

    public function paginate(int $perPage = 15)
    {
        return $this->foodStallRepository->paginateDetailed($perPage);
    }

    public function show(FoodStall $foodStall): FoodStall
    {
        return $this->foodStallRepository->findDetailed($foodStall);
    }

    public function store(array $data): FoodStall
    {
        return $this->foodStallRepository->create($data);
    }

    public function update(FoodStall $foodStall, array $data): FoodStall
    {
        return $this->foodStallRepository->update($foodStall, $data);
    }

    public function destroy(FoodStall $foodStall): void
    {
        $this->foodStallRepository->delete($foodStall);
    }
}

