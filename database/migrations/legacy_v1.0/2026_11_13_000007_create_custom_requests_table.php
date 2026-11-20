<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Task ID: DB-017 — Migration Custom Requests
     */
    public function up(): void
    {
        Schema::create('custom_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->unique()->constrained('orders')->onDelete('cascade');
            $table->string('flower_type_preference', 150)->nullable();
            $table->string('color_scheme', 100)->nullable();
            $table->string('wrapping_type', 100)->nullable();
            $table->string('event_theme', 100)->nullable();
            $table->text('custom_note')->nullable();
            $table->decimal('estimated_budget', 12, 2)->nullable();
            $table->decimal('agreed_price', 12, 2)->nullable(); // Diisi saat Florist tetapkan harga (BR-007)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_requests');
    }
};

