<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aspirasi_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aspirasi_id')->constrained('aspirasi')->cascadeOnDelete();
            $table->text('keterangan');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasi_progress');
    }
};
