<?php

namespace Database\Seeders;

use App\Models\FoodStall;
use App\Models\License;
use Illuminate\Database\Seeder;

class LicenseSeeder extends Seeder
{
    public function run(): void
    {
        $stalls = FoodStall::query()->take(5)->get();
        $statuses = ['vigente', 'vigente', 'vencida', 'vigente', 'suspendida'];

        foreach ($stalls as $index => $stall) {
            License::query()->create([
                'stall_id' => $stall->id,
                'license_number' => 'LIC-2026-00'.($index + 1),
                'issue_date' => now()->subMonths(6 + $index)->toDateString(),
                'expiration_date' => now()->addMonths(12 - $index)->toDateString(),
                'status' => $statuses[$index],
            ]);
        }
    }
}

