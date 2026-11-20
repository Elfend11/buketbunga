<?php

namespace App\Services;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderCodeGeneratorService
{
    /**
     * Generate unique sequential order code: BLM-YYYYMM-XXXX
     * Task ID: BE-008 / ARC-007
     */
    public function generate(): string
    {
        $now = Carbon::now();
        $prefix = 'BLM-' . $now->format('Ym'); // e.g. BLM-202611

        // Dijalankan dalam lock untuk mencegah tabrakan ID urut (race condition)
        $latestOrder = Order::where('order_code', 'LIKE', "{$prefix}-%")
            ->lockForUpdate()
            ->latest('id')
            ->first();

        if (!$latestOrder) {
            $nextSequence = 1;
        } else {
            // Ambil 4 digit terakhir
            $lastCode = $latestOrder->order_code;
            $parts = explode('-', $lastCode);
            $lastSequence = (int) end($parts);
            $nextSequence = $lastSequence + 1;
        }

        $paddedSequence = str_pad((string) $nextSequence, 4, '0', STR_PAD_LEFT);

        return "{$prefix}-{$paddedSequence}";
    }
}

