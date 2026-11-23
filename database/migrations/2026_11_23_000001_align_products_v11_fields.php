<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('products')) {
            return;
        }

        if (Schema::hasColumn('products', 'base_price') && !Schema::hasColumn('products', 'price')) {
            Schema::table('products', function (Blueprint $table) {
                $table->renameColumn('base_price', 'price');
            });
        }

        if (Schema::hasColumn('products', 'main_image') && !Schema::hasColumn('products', 'image_path')) {
            Schema::table('products', function (Blueprint $table) {
                $table->renameColumn('main_image', 'image_path');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('products')) {
            return;
        }

        if (Schema::hasColumn('products', 'price') && !Schema::hasColumn('products', 'base_price')) {
            Schema::table('products', function (Blueprint $table) {
                $table->renameColumn('price', 'base_price');
            });
        }

        if (Schema::hasColumn('products', 'image_path') && !Schema::hasColumn('products', 'main_image')) {
            Schema::table('products', function (Blueprint $table) {
                $table->renameColumn('image_path', 'main_image');
            });
        }
    }
};
