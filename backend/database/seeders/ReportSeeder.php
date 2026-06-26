<?php

namespace Database\Seeders;

use App\Models\FoodStall;
use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        $citizens = User::query()->where('role', User::ROLE_CITIZEN)->get();
        $stalls = FoodStall::query()->get();
        $statuses = ['pendiente', 'en_proceso', 'resuelto', 'rechazado'];

        for ($index = 0; $index < 10; $index++) {
            Report::query()->create([
                'citizen_id' => $citizens[$index % $citizens->count()]->id,
                'stall_id' => $stalls[$index % $stalls->count()]->id,
                'description' => 'Reporte ciudadano #'.($index + 1).' sobre manipulación de alimentos y limpieza del puesto.',
                'status' => $statuses[$index % count($statuses)],
            ]);
        }
    }
}

