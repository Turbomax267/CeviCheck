<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('stall_id')->constrained('food_stalls')->cascadeOnDelete();
            $table->enum('document_type', ['licencia', 'foto', 'inspeccion', 'otro']);
            $table->string('file_path', 255);
            $table->timestamp('uploaded_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};

