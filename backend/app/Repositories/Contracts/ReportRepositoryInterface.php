<?php

namespace App\Repositories\Contracts;

use App\Models\Report;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ReportRepositoryInterface
{
    public function paginateForUser(?int $userId, bool $isAdmin, int $perPage = 15): LengthAwarePaginator;

    public function create(array $data): Report;

    public function update(Report $report, array $data): Report;

    public function delete(Report $report): void;
}

