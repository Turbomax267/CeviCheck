<?php

namespace App\Repositories\Contracts;

use App\Models\Inspection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface InspectionRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator;

    public function create(array $data): Inspection;

    public function update(Inspection $inspection, array $data): Inspection;

    public function delete(Inspection $inspection): void;
}

