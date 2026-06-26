<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            VendorSeeder::class,
            FoodStallSeeder::class,
            LicenseSeeder::class,
            InspectionSeeder::class,
            DocumentSeeder::class,
            ReportSeeder::class,
        ]);
    }
}

