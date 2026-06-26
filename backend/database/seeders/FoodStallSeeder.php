<?php

namespace Database\Seeders;

use App\Models\FoodStall;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class FoodStallSeeder extends Seeder
{
    public function run(): void
    {
        $vendors = Vendor::query()->get();
        $districts = ['Miraflores', 'Surco', 'Barranco', 'San Miguel', 'Chorrillos', 'Magdalena', 'Jesús María', 'Lince'];
        $licenses = ['vigente', 'vigente', 'vencida', 'vigente', 'sin_licencia', 'suspendida', 'vigente', 'sin_licencia'];
        $sanitary = ['apto', 'apto', 'pendiente', 'apto', 'no_apto', 'pendiente', 'apto', 'pendiente'];

        for ($index = 0; $index < 8; $index++) {
            FoodStall::query()->create([
                'vendor_id' => $vendors[$index % $vendors->count()]->id,
                'stall_name' => 'Cevichería Móvil '.($index + 1),
                'district' => $districts[$index],
                'address' => 'Av. Costera '.(100 + $index * 7),
                'license_status' => $licenses[$index],
                'sanitary_status' => $sanitary[$index],
            ]);
        }
    }
}

