<?php

namespace Database\Seeders;

use App\Models\FoodStall;
use App\Models\Inspection;
use App\Models\User;
use Illuminate\Database\Seeder;

class InspectionSeeder extends Seeder
{
    public function run(): void
    {
        $stalls = FoodStall::query()->take(6)->get();
        $admins = User::query()->where('role', User::ROLE_ADMIN)->get();
        $statuses = ['apto', 'apto', 'pendiente', 'no_apto', 'pendiente', 'apto'];

        foreach ($stalls as $index => $stall) {
            Inspection::query()->create([
                'stall_id' => $stall->id,
                'inspection_date' => now()->subDays(($index + 1) * 5)->toDateString(),
                'observations' => 'Inspección '.($index + 1).' con observaciones sanitarias registradas.',
                'sanitary_status' => $statuses[$index],
                'inspected_by' => $admins[$index % $admins->count()]->id,
            ]);
        }
    }
}

