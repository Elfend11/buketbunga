<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Task ID: DB-018 — Migration Custom References (Upload Foto Referensi Pelanggan)
     */
    public function up(): void
    {
        Schema::create('custom_references', function (Blueprint $table) {
            $table->id();
            $table->foreignId('custom_request_id')->constrained('custom_requests')->onDelete('cascade');
            $table->string('file_path', 255); // Path tersanitasi UUID di disk public
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_references');
    }
};

