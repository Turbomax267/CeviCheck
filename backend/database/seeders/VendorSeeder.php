<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        $vendorUsers = User::query()->where('role', User::ROLE_VENDOR)->get();

        foreach ($vendorUsers as $index => $user) {
            Vendor::query()->create([
                'user_id' => $user->id,
                'dni' => str_pad((string) (70120000 + $index + 1), 8, '0', STR_PAD_LEFT),
                'full_name' => $user->name.' Quispe',
                'phone' => '9990000'.($index + 1),
            ]);
        }
    }
}

