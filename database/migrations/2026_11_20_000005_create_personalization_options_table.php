<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Task ID: DB-015 — Migration Personalization Options (v1.1)
     */
    public function up(): void
    {
        Schema::create('personalization_options', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('type', 50)->default('select'); // select, radio, color_swatch
            $table->boolean('is_required')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personalization_options');
    }
};

