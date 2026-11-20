<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Services\OrderStatusStateMachineService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminPaymentController extends Controller
{
    protected OrderStatusStateMachineService $stateMachine;

    public function __construct(OrderStatusStateMachineService $stateMachine)
    {
        $this->stateMachine = $stateMachine;
    }

    /**
     * Antrean Bukti Transfer yang Menunggu Audit Mutasi Bank
     * Task ID: ARC-006 / UX-035
     */
    public function index(Request $request)
    {
        $query = Payment::with('order.customer')->latest();

        if ($request->filled('status')) {
            $query->where('verification_status', $request->status);
        } else {
            $query->where('verification_status', 'pending');
        }

        $payments = $query->paginate(15)->withQueryString();

        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Menyetujui Pembayaran Transfer Manual (Status -> ST-05 Diproses)
     * Task ID: ARC-006 / UX-036 / BE-072
     */
    public function verify(int $id)
    {
        $payment = Payment::with('order')->findOrFail($id);
        $order = $payment->order;
        $adminId = Auth::guard('admin')->id();

        DB::transaction(function () use ($payment, $order, $adminId) {
            $payment->update([
                'verification_status' => 'verified',
                'verified_at' => Carbon::now(),
            ]);

            $this->stateMachine->transition(
                $order,
                'ST-05',
                "Pembayaran sebesar Rp " . number_format($payment->amount_paid, 0, ',', '.') . " telah diverifikasi sah oleh Florist.",
                $adminId
            );
        });

        return back()->with('success', "Pembayaran untuk pesanan [{$order->order_code}] berhasil diverifikasi! Pesanan beralih ke status [Diproses].");
    }

    /**
     * Menolak Pembayaran Transfer (Status -> ST-03 Pembayaran Ditolak)
     */
    public function reject(Request $request, int $id)
    {
        $request->validate([
            'reason' => ['required', 'string', 'max:500'],
        ]);

        $payment = Payment::with('order')->findOrFail($id);
        $order = $payment->order;
        $reason = $request->input('reason');
        $adminId = Auth::guard('admin')->id();

        DB::transaction(function () use ($payment, $order, $reason, $adminId) {
            $payment->update([
                'verification_status' => 'rejected',
            ]);

            $this->stateMachine->transition(
                $order,
                'ST-03',
                "Pembayaran ditolak: {$reason}",
                $adminId
            );
        });

        return back()->with('info', "Pembayaran untuk pesanan [{$order->order_code}] telah ditolak. Alasan tercatat di histori.");
    }
}

