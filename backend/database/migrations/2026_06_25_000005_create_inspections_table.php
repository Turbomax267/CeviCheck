<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inspections', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('stall_id')->constrained('food_stalls')->cascadeOnDelete();
            $table->date('inspection_date');
            $table->text('observations')->nullable();
            $table->enum('sanitary_status', ['apto', 'pendiente', 'no_apto']);
            $table->foreignId('inspected_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};

