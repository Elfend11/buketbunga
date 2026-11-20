<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Models\Order;
use App\Services\OrderStatusStateMachineService;
use Illuminate\Support\Facades\Auth;

class AdminOrderStatusController extends Controller
{
    protected OrderStatusStateMachineService $stateMachine;

    public function __construct(OrderStatusStateMachineService $stateMachine)
    {
        $this->stateMachine = $stateMachine;
    }

    /**
     * Memperbarui Status Fisik Pesanan (FSM Engine)
     * Task ID: ARC-006 / UX-037 / BE-064
     */
    public function update(UpdateOrderStatusRequest $request, int $id)
    {
        $order = Order::findOrFail($id);
        $targetStatus = $request->input('status');
        $notes = $request->input('notes', 'Status diperbarui oleh Florist melalui panel admin.');
        $adminId = Auth::guard('admin')->id();

        try {
            $this->stateMachine->transition($order, $targetStatus, $notes, $adminId);

            return back()->with('success', "Status pesanan [{$order->order_code}] berhasil diubah menjadi [{$targetStatus}].");
        } catch (\InvalidArgumentException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}

