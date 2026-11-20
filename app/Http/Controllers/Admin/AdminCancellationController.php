<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderStatusStateMachineService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCancellationController extends Controller
{
    protected OrderStatusStateMachineService $stateMachine;

    public function __construct(OrderStatusStateMachineService $stateMachine)
    {
        $this->stateMachine = $stateMachine;
    }

    /**
     * Antrean Pengajuan Pembatalan yang Memerlukan Persetujuan Admin
     * Task ID: ARC-006 / UX-038 / BE-077
     */
    public function index()
    {
        $orders = Order::with(['customer', 'statusHistories'])
            ->whereIn('current_status', ['ST-01', 'ST-02', 'ST-05', 'ST-08'])
            ->latest()
            ->paginate(15);

        return view('admin.cancellations.index', compact('orders'));
    }

    /**
     * Memproses Persetujuan Pembatalan Pesanan
     */
    public function process(Request $request, int $id)
    {
        $request->validate([
            'action' => ['required', 'in:approve,reject'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $order = Order::findOrFail($id);
        $action = $request->input('action');
        $notes = $request->input('notes', 'Evaluasi permohonan pembatalan oleh Florist.');
        $adminId = Auth::guard('admin')->id();

        if ($action === 'approve') {
            $this->stateMachine->transition($order, 'ST-08', "Pembatalan disetujui admin: {$notes}", $adminId);
            return back()->with('success', "Pesanan [{$order->order_code}] resmi dibatalkan.");
        } else {
            return back()->with('info', "Permohonan pembatalan pesanan [{$order->order_code}] ditolak. Pesanan tetap aktif.");
        }
    }
}

