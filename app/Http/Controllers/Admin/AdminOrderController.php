<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\WhatsAppLinkGeneratorService;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    protected WhatsAppLinkGeneratorService $waService;

    public function __construct(WhatsAppLinkGeneratorService $waService)
    {
        $this->waService = $waService;
    }

    /**
     * Master Daftar Pesanan Masuk dengan Filter Status
     * Task ID: ARC-006 / UX-030
     */
    public function index(Request $request)
    {
        $query = Order::with('customer')->latest();

        if ($request->filled('status')) {
            $query->where('current_status', $request->status);
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('delivery_date', $request->tanggal);
        }

        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('order_code', 'LIKE', "%{$keyword}%")
                  ->orWhereHas('customer', function ($cq) use ($keyword) {
                      $cq->where('name', 'LIKE', "%{$keyword}%")
                         ->orWhere('phone', 'LIKE', "%{$keyword}%");
                  });
            });
        }

        $orders = $query->paginate(15)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Rincian Lengkap Pesanan, Ucapan Kartu, dan Audit Log
     * Task ID: ARC-006 / UX-031
     */
    public function show(int $id)
    {
        $order = Order::with([
            'customer',
            'orderDetails.product',
            'customRequest.references',
            'payments',
            'statusHistories.admin'
        ])->findOrFail($id);

        $waLink = $this->waService->generateOrderReadyLink($order);

        return view('admin.orders.show', compact('order', 'waLink'));
    }
}

