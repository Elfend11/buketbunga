<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Task ID: DB-015 — Migration Orders (Master Transactions)
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code', 25)->unique(); // BLM-YYYYMM-XXXX
            $table->foreignId('customer_id')->constrained('customers')->onDelete('restrict');
            $table->enum('order_type', ['catalog', 'custom']);
            $table->decimal('total_amount', 12, 2)->default(0.00);
            $table->enum('current_status', [
                'ST-01', // Menunggu Pembayaran
                'ST-02', // Menunggu Verifikasi Pembayaran
                'ST-03', // Pembayaran Ditolak
                'ST-04', // Menunggu Konfirmasi Harga Custom
                'ST-05', // Diproses (Florist)
                'ST-06', // Siap Diambil / Dikirim
                'ST-07', // Selesai
                'ST-08'  // Dibatalkan
            ])->default('ST-01');
            $table->date('delivery_date'); // Minimal H+1
            $table->text('greeting_card_message')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            // Composite Index untuk filter antrean operasional harian (DB-008)
            $table->index(['current_status', 'delivery_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

