<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    /**
     * Menyajikan Metrik Operasional & Antrean Pesanan Hari Ini
     * Task ID: ARC-006 / UX-026 / BE-061
     */
    public function index()
    {
        $today = Carbon::today();

        // 4 Metrik Utama
        $newOrdersTodayCount = Order::whereDate('created_at', $today)->count();
        $pendingVerificationCount = Order::where('current_status', 'ST-02')->count();
        $customNeedsPricingCount = Order::where('current_status', 'ST-04')->count();
        $monthlyRevenue = Payment::where('verification_status', 'verified')
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('amount_paid');

        // 5 Pesanan Prioritas yang Butuh Tindakan Segera
        $urgentOrders = Order::with(['customer', 'customRequest'])
            ->whereIn('current_status', ['ST-02', 'ST-04', 'ST-05'])
            ->orderBy('delivery_date', 'asc')
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'newOrdersTodayCount',
            'pendingVerificationCount',
            'customNeedsPricingCount',
            'monthlyRevenue',
            'urgentOrders'
        ));
    }
}

