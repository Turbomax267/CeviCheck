<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('food_stalls', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('vendor_id')->constrained('vendors')->cascadeOnDelete();
            $table->string('stall_name', 120);
            $table->string('district', 80);
            $table->string('address', 200);
            $table->enum('license_status', ['vigente', 'vencida', 'suspendida', 'sin_licencia']);
            $table->enum('sanitary_status', ['apto', 'pendiente', 'no_apto']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('food_stalls');
    }
};

