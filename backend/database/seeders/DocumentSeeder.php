<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\FoodStall;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    public function run(): void
    {
        $stalls = FoodStall::query()->take(6)->get();
        $types = ['licencia', 'foto', 'inspeccion', 'otro', 'foto', 'licencia'];

        foreach ($stalls as $index => $stall) {
            Document::query()->create([
                'stall_id' => $stall->id,
                'document_type' => $types[$index],
                'file_path' => 'documents/sample-'.$stall->id.'.pdf',
                'uploaded_at' => now()->subDays($index + 1),
            ]);
        }
    }
}

