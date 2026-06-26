<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('licenses', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('stall_id')->constrained('food_stalls')->cascadeOnDelete();
            $table->string('license_number', 50)->unique();
            $table->date('issue_date');
            $table->date('expiration_date');
            $table->enum('status', ['vigente', 'vencida', 'suspendida']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};

