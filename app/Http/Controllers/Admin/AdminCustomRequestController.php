<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SetCustomPriceRequest;
use App\Models\Order;
use App\Services\CustomPriceService;
use Illuminate\Support\Facades\Auth;

class AdminCustomRequestController extends Controller
{
    protected CustomPriceService $customPriceService;

    public function __construct(CustomPriceService $customPriceService)
    {
        $this->customPriceService = $customPriceService;
    }

    /**
     * Antrean Pengajuan Buket Custom
     * Task ID: ARC-006 / UX-032
     */
    public function index()
    {
        $orders = Order::with(['customer', 'customRequest.references'])
            ->where('order_type', 'custom')
            ->latest()
            ->paginate(15);

        return view('admin.custom.index', compact('orders'));
    }

    /**
     * Rincian Spesifikasi & Galeri Foto Referensi Custom
     * Task ID: ARC-006 / UX-033
     */
    public function show(int $id)
    {
        $order = Order::with(['customer', 'customRequest.references', 'statusHistories'])
            ->where('order_type', 'custom')
            ->findOrFail($id);

        return view('admin.custom.show', compact('order'));
    }

    /**
     * Menetapkan Estimasi Harga Final Buket Kustom (BR-007)
     * Task ID: ARC-006 / UX-034
     */
    public function setPrice(SetCustomPriceRequest $request, int $id)
    {
        $order = Order::with(['customer', 'customRequest'])->findOrFail($id);
        $agreedPrice = (float) $request->input('agreed_price');
        $adminNotes = $request->input('admin_notes');
        $adminId = Auth::guard('admin')->id();

        try {
            $result = $this->customPriceService->setPrice($order, $agreedPrice, $adminNotes, $adminId);

            return redirect()->route('admin.custom.show', $id)
                ->with('success', 'Harga penawaran kustom berhasil ditetapkan!')
                ->with('wa_url', $result['wa_url']);
        } catch (\InvalidArgumentException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}

