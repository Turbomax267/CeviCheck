<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            ['name' => 'Admin General', 'email' => 'admin1@cevicheck.pe'],
            ['name' => 'Admin Salud', 'email' => 'admin2@cevicheck.pe'],
            ['name' => 'Admin Operaciones', 'email' => 'admin3@cevicheck.pe'],
        ];

        foreach ($admins as $admin) {
            User::query()->create([
                ...$admin,
                'password' => Hash::make('password123'),
                'role' => User::ROLE_ADMIN,
            ]);
        }

        for ($index = 1; $index <= 5; $index++) {
            User::query()->create([
                'name' => "Vendedor {$index}",
                'email' => "vendor{$index}@cevicheck.pe",
                'password' => Hash::make('password123'),
                'role' => User::ROLE_VENDOR,
            ]);
        }

        for ($index = 1; $index <= 4; $index++) {
            User::query()->create([
                'name' => "Ciudadano {$index}",
                'email' => "citizen{$index}@cevicheck.pe",
                'password' => Hash::make('password123'),
                'role' => User::ROLE_CITIZEN,
            ]);
        }
    }
}

