<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Task ID: DB-016 — Migration Personalization Values (v1.1)
     */
    public function up(): void
    {
        Schema::create('personalization_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('option_id')->constrained('personalization_options')->onDelete('cascade');
            $table->string('value_name', 100);
            $table->decimal('additional_price', 12, 2)->default(0.00);
            $table->string('color_hex', 20)->nullable();
            $table->boolean('is_available')->default(true)->index();
            $table->timestamps();

            $table->index(['option_id', 'is_available']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personalization_values');
    }
};

