<?php

namespace App\Services;

use App\Models\Report;
use App\Models\User;
use App\Repositories\Contracts\ReportRepositoryInterface;

class ReportService
{
    public function __construct(private readonly ReportRepositoryInterface $reportRepository)
    {
    }

    public function paginate(User $user, int $perPage = 15)
    {
        return $this->reportRepository->paginateForUser(
            $user->id,
            $user->role === User::ROLE_ADMIN,
            $perPage
        );
    }

    public function store(User $user, array $data): Report
    {
        $data['citizen_id'] = $data['citizen_id'] ?? $user->id;
        $data['status'] = $data['status'] ?? Report::STATUS_PENDING;

        return $this->reportRepository->create($data)->load(['citizen', 'stall.vendor']);
    }

    public function update(Report $report, array $data): Report
    {
        return $this->reportRepository->update($report, $data);
    }

    public function destroy(Report $report): void
    {
        $this->reportRepository->delete($report);
    }
}

