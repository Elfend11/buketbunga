<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentProofRequest;
use App\Models\Order;
use App\Models\Payment;
use App\Services\FileUploadSanitizerService;
use App\Services\OrderStatusStateMachineService;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    protected FileUploadSanitizerService $fileService;
    protected OrderStatusStateMachineService $stateMachine;

    public function __construct(
        FileUploadSanitizerService $fileService,
        OrderStatusStateMachineService $stateMachine
    ) {
        $this->fileService = $fileService;
        $this->stateMachine = $stateMachine;
    }

    /**
     * Menampilkan Formulir Konfirmasi Pembayaran & Nomor Rekening Resmi Butik
     * Task ID: ARC-006 / UX-021
     */
    public function create(string $orderCode)
    {
        $order = Order::with('customer')->where('order_code', $orderCode)->firstOrFail();

        // Hanya pesanan dengan status ST-01 (Menunggu Pembayaran) atau ST-03 (Pembayaran Ditolak) yang butuh bukti bayar
        if (!in_array($order->current_status, ['ST-01', 'ST-03'], true)) {
            return redirect()->route('tracking.show', $orderCode)
                ->with('info', "Pesanan ini saat ini berada dalam status: [{$order->current_status}].");
        }

        return view('customer.payment.create', compact('order'));
    }

    /**
     * Menyimpan Berkas Struk Transfer dan Mengubah Status Menjadi ST-02 (Menunggu Verifikasi)
     * Task ID: ARC-006 / BE-068..074
     */
    public function store(StorePaymentProofRequest $request, string $orderCode)
    {
        $order = Order::where('order_code', $orderCode)->firstOrFail();

        $validated = $request->validated();
        $storedProofPath = null;

        try {
            // 1. Simpan berkas bukti transfer dengan nama acak UUID ke disk public
            $storedProofPath = $this->fileService->storeImage(
                $request->file('proof_file'),
                'payment_proofs'
            );

            // 2. Transaksi database
            DB::transaction(function () use ($order, $validated, $storedProofPath) {
                // Catat transaksi pembayaran
                Payment::create([
                    'order_id' => $order->id,
                    'payment_method' => $validated['payment_method'],
                    'amount_paid' => $validated['amount_paid'],
                    'proof_file_path' => $storedProofPath,
                    'verification_status' => 'pending',
                ]);

                // Transisi status menjadi ST-02 (Menunggu Verifikasi Pembayaran)
                $this->stateMachine->transition(
                    $order,
                    'ST-02',
                    "Pelanggan mengunggah bukti transfer {$validated['payment_method']} sebesar Rp " . number_format($validated['amount_paid'], 0, ',', '.')
                );
            });

            return redirect()->route('tracking.show', $orderCode)
                ->with('success', 'Bukti pembayaran berhasil diunggah! Florist kami akan segera memverifikasi mutasi rekening Anda.');

        } catch (\Throwable $e) {
            if ($storedProofPath) {
                $this->fileService->deleteImage($storedProofPath);
            }
            throw $e;
        }
    }
}

