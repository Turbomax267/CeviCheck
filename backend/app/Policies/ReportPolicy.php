<?php

namespace App\Policies;

use App\Models\Report;
use App\Models\User;

class ReportPolicy
{
    public function view(User $user, Report $report): bool
    {
        return $user->role === User::ROLE_ADMIN || $report->citizen_id === $user->id;
    }
}

