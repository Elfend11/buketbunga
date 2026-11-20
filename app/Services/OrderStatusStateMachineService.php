<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderStatusHistory;
use InvalidArgumentException;

class OrderStatusStateMachineService
{
    /**
     * Matriks Transisi Status Legal (FSM Rules ARC-007)
     * ST-01: Menunggu Pembayaran
     * ST-02: Menunggu Verifikasi Pembayaran
     * ST-03: Pembayaran Ditolak
     * ST-04: Menunggu Konfirmasi Harga Custom
     * ST-05: Diproses Florist
     * ST-06: Siap Diambil / Dikirim
     * ST-07: Selesai
     * ST-08: Dibatalkan
     */
    private const LEGAL_TRANSITIONS = [
        'ST-01' => ['ST-02', 'ST-08'],
        'ST-02' => ['ST-05', 'ST-03'],
        'ST-03' => ['ST-02', 'ST-08'],
        'ST-04' => ['ST-01', 'ST-08'],
        'ST-05' => ['ST-06', 'ST-08'],
        'ST-06' => ['ST-07'],
        'ST-07' => [], // Final state
        'ST-08' => [], // Final state
    ];

    /**
     * Memeriksa apakah transisi dari current_status ke targetStatus sah
     */
    public function canTransition(string $currentStatus, string $targetStatus): bool
    {
        $allowed = self::LEGAL_TRANSITIONS[$currentStatus] ?? [];
        return in_array($targetStatus, $allowed, true);
    }

    /**
     * Mengeksekusi transisi status dan mencatat audit history
     */
    public function transition(Order $order, string $targetStatus, ?string $notes = null, ?int $adminId = null): Order
    {
        if (!$this->canTransition($order->current_status, $targetStatus)) {
            throw new InvalidArgumentException(
                "Transisi status dari [{$order->current_status}] ke [{$targetStatus}] tidak diizinkan oleh aturan bisnis FSM."
            );
        }

        $order->update([
            'current_status' => $targetStatus,
        ]);

        OrderStatusHistory::create([
            'order_id' => $order->id,
            'admin_id' => $adminId,
            'status' => $targetStatus,
            'notes' => $notes,
        ]);

        return $order;
    }
}

