<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\WhatsAppLinkGeneratorService;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    protected WhatsAppLinkGeneratorService $waService;

    public function __construct(WhatsAppLinkGeneratorService $waService)
    {
        $this->waService = $waService;
    }

    /**
     * Menampilkan Formulir Pencarian Kode Pesanan
     * Task ID: ARC-006 / UX-022
     */
    public function index(Request $request)
    {
        if ($request->filled('kode')) {
            $code = trim($request->input('kode'));
            return redirect()->route('tracking.show', ['order_code' => $code]);
        }

        return view('customer.tracking.index');
    }

    /**
     * Menampilkan Visualisasi Timeline Status Pesanan & Rincian Lengkap
     * Task ID: ARC-006 / UX-022
     */
    public function show(string $orderCode)
    {
        $order = Order::with([
            'customer',
            'orderDetails.product',
            'customRequest.references',
            'payments',
            'statusHistories'
        ])->where('order_code', $orderCode)->firstOrFail();

        $waLink = $this->waService->generateCustomerOrderLink($order);

        return view('customer.tracking.show', compact('order', 'waLink'));
    }
}

