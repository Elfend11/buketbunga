<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Task ID: DB-017 — Migration Product Personalization Options Pivot (v1.1)
     */
    public function up(): void
    {
        Schema::create('product_personalization_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('option_id')->constrained('personalization_options')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['product_id', 'option_id'], 'prod_pers_opt_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_personalization_options');
    }
};

