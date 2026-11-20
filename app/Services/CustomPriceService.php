<?php

namespace App\Services;

use App\Models\Order;
use App\Models\CustomRequest;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class CustomPriceService
{
    protected OrderStatusStateMachineService $stateMachine;
    protected WhatsAppLinkGeneratorService $waService;

    public function __construct(
        OrderStatusStateMachineService $stateMachine,
        WhatsAppLinkGeneratorService $waService
    ) {
        $this->stateMachine = $stateMachine;
        $this->waService = $waService;
    }

    /**
     * Menetapkan estimasi harga final buket custom oleh Florist (BR-007)
     */
    public function setPrice(Order $order, float $agreedPrice, ?string $adminNotes = null, ?int $adminId = null): array
    {
        if ($order->order_type !== 'custom') {
            throw new InvalidArgumentException("Pesanan ini bukan bertipe custom bouquet.");
        }

        if ($agreedPrice < 10000) {
            throw new InvalidArgumentException("Nominal harga custom minimal Rp 10.000.");
        }

        return DB::transaction(function () use ($order, $agreedPrice, $adminNotes, $adminId) {
            // 1. Update agreed_price pada custom_requests
            $customRequest = $order->customRequest;
            if ($customRequest) {
                $customRequest->update(['agreed_price' => $agreedPrice]);
            }

            // 2. Update total_amount pada orders
            $order->update(['total_amount' => $agreedPrice]);

            // 3. Transisi status dari ST-04 (Menunggu Harga) ke ST-01 (Menunggu Pembayaran)
            $this->stateMachine->transition(
                $order,
                'ST-01',
                $adminNotes ?? "Harga penawaran florist disetujui sebesar Rp " . number_format($agreedPrice, 0, ',', '.'),
                $adminId
            );

            // 4. Generate tautan WhatsApp konfirmasi harga
            $waUrl = $this->waService->generatePriceOfferLink($order, $agreedPrice);

            return [
                'order' => $order->fresh(),
                'wa_url' => $waUrl,
            ];
        });
    }
}

