<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCatalogOrderRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Services\OrderCodeGeneratorService;
use App\Services\OrderStatusStateMachineService;
use App\Services\WhatsAppLinkGeneratorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected OrderCodeGeneratorService $codeGenerator;
    protected OrderStatusStateMachineService $stateMachine;
    protected WhatsAppLinkGeneratorService $waService;

    public function __construct(
        OrderCodeGeneratorService $codeGenerator,
        OrderStatusStateMachineService $stateMachine,
        WhatsAppLinkGeneratorService $waService
    ) {
        $this->codeGenerator = $codeGenerator;
        $this->stateMachine = $stateMachine;
        $this->waService = $waService;
    }

    /**
     * Menampilkan Formulir Pemesanan Buket Katalog (Guest Checkout)
     * Task ID: ARC-006 / UX-017
     */
    public function create(string $slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();

        if (!$product->is_available) {
            return redirect()->route('catalog.show', $slug)
                ->with('error', 'Maaf, buket bunga ini sedang habis stok.');
        }

        return view('customer.order.create', compact('product'));
    }

    /**
     * Menyimpan Pesanan Baru ke Database Secara Atomik (DB::transaction)
     * Task ID: ARC-006 / BE-042
     */
    public function store(StoreCatalogOrderRequest $request, string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        if (!$product->is_available) {
            return back()->with('error', 'Maaf, buket bunga ini sedang tidak tersedia.');
        }

        $validated = $request->validated();

        $order = DB::transaction(function () use ($validated, $product) {
            // 1. Catat atau update profil pembeli tamu
            $customer = Customer::create([
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
            ]);

            // 2. Generate kode pesanan BLM-YYYYMM-XXXX
            $orderCode = $this->codeGenerator->generate();

            // 3. Buat pesanan master
            $order = Order::create([
                'order_code' => $orderCode,
                'customer_id' => $customer->id,
                'order_type' => 'catalog',
                'total_amount' => $product->price,
                'current_status' => 'ST-01', // Menunggu Pembayaran
                'delivery_date' => $validated['delivery_date'],
                'greeting_card_message' => $validated['greeting_card_message'] ?? null,
                'note' => $validated['note'] ?? null,
            ]);

            // 4. Catat item rincian dengan snapshot harga permanen (BR-020)
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name_snapshot' => $product->name,
                'unit_price_snapshot' => $product->price,
                'quantity' => 1,
                'subtotal' => $product->price,
            ]);

            // 5. Catat audit history awal
            $this->stateMachine->transition(
                $order,
                'ST-01',
                'Pesanan buket katalog berhasil dibuat oleh pelanggan (Guest Checkout).'
            );

            return $order;
        });

        return redirect()->route('order.summary', ['order_code' => $order->order_code])
            ->with('success', 'Pesanan Anda berhasil dibuat! Silakan lakukan pembayaran sesuai petunjuk.');
    }

    /**
     * Menampilkan Halaman Ringkasan Pesanan & Petunjuk Rekening Bank
     * Task ID: ARC-006 / UX-020
     */
    public function summary(string $orderCode)
    {
        $order = Order::with(['customer', 'orderDetails.product', 'payments', 'statusHistories'])
            ->where('order_code', $orderCode)
            ->firstOrFail();

        $waLink = $this->waService->generateCustomerOrderLink($order);

        return view('customer.order.summary', compact('order', 'waLink'));
    }

    /**
     * Pembatalan Mandiri oleh Pelanggan (Hanya diizinkan di status ST-01 / ST-04 - BR-017)
     */
    public function cancel(Request $request, string $orderCode)
    {
        $order = Order::where('order_code', $orderCode)->firstOrFail();

        if (!in_array($order->current_status, ['ST-01', 'ST-04'], true)) {
            return back()->with('error', 'Pesanan tidak dapat dibatalkan karena sudah dalam proses pembuatan oleh florist.');
        }

        $reason = $request->input('reason', 'Dibatalkan mandiri oleh pemesan.');

        $this->stateMachine->transition($order, 'ST-08', $reason);

        return redirect()->route('tracking.show', $orderCode)
            ->with('info', 'Pesanan Anda telah dibatalkan.');
    }
}

