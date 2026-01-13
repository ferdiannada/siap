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
        Schema::create('aspirasi_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aspirasi_id')->constrained('aspirasi')->cascadeOnDelete();
            $table->string('status_lama');
            $table->string('status_baru');
            $table->foreignId('admin_id')->constrained('users');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasi_histories');
    }
};
