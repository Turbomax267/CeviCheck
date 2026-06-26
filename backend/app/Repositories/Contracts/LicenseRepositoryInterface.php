<?php

namespace App\Repositories\Contracts;

use App\Models\License;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface LicenseRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator;

    public function create(array $data): License;

    public function update(License $license, array $data): License;

    public function delete(License $license): void;
}

