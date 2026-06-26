<?php

namespace App\Repositories\Eloquent;

use App\Models\Report;
use App\Repositories\Contracts\ReportRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ReportRepository implements ReportRepositoryInterface
{
    public function paginateForUser(?int $userId, bool $isAdmin, int $perPage = 15): LengthAwarePaginator
    {
        return Report::query()
            ->with(['citizen', 'stall.vendor'])
            ->when(! $isAdmin, fn ($query) => $query->where('citizen_id', $userId))
            ->latest()
            ->paginate($perPage);
    }

    public function create(array $data): Report
    {
        return Report::query()->create($data);
    }

    public function update(Report $report, array $data): Report
    {
        $report->update($data);

        return $report->refresh()->load(['citizen', 'stall.vendor']);
    }

    public function delete(Report $report): void
    {
        $report->delete();
    }
}

