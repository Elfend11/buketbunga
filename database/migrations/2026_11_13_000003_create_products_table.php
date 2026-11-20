<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Task ID: DB-013 — Migration Products
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict');
            $table->string('name', 150);
            $table->string('slug', 180)->unique();
            $table->decimal('price', 12, 2);
            $table->text('description');
            $table->string('image_path', 255);
            $table->boolean('is_available')->default(true);
            $table->timestamps();

            // Composite Index untuk optimasi kueri katalog etalase (DB-008)
            $table->index(['is_available', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

