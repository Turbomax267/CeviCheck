<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendors', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('dni', 8)->unique();
            $table->string('full_name', 120);
            $table->string('phone', 20);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};

