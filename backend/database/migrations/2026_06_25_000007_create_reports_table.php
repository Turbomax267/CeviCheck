<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('citizen_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('stall_id')->constrained('food_stalls')->cascadeOnDelete();
            $table->text('description');
            $table->enum('status', ['pendiente', 'en_proceso', 'resuelto', 'rechazado'])->default('pendiente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};

