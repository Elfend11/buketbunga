<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomOrderRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\CustomRequest;
use App\Models\CustomReference;
use App\Services\FileUploadSanitizerService;
use App\Services\OrderCodeGeneratorService;
use App\Services\OrderStatusStateMachineService;
use Illuminate\Support\Facades\DB;

class CustomBouquetController extends Controller
{
    protected OrderCodeGeneratorService $codeGenerator;
    protected OrderStatusStateMachineService $stateMachine;
    protected FileUploadSanitizerService $fileService;

    public function __construct(
        OrderCodeGeneratorService $codeGenerator,
        OrderStatusStateMachineService $stateMachine,
        FileUploadSanitizerService $fileService
    ) {
        $this->codeGenerator = $codeGenerator;
        $this->stateMachine = $stateMachine;
        $this->fileService = $fileService;
    }

    /**
     * Menampilkan Formulir Pengajuan Personalisasi Buket Custom
     * Task ID: ARC-006 / UX-018
     */
    public function create()
    {
        return view('customer.custom.create');
    }

    /**
     * Menyimpan Permintaan Custom & Unggah Maks 3 Foto Referensi (<=5MB)
     * Task ID: ARC-006 / BE-047..051
     */
    public function store(StoreCustomOrderRequest $request)
    {
        $validated = $request->validated();

        $uploadedPaths = [];

        try {
            // 1. Unggah dan sanitasi berkas foto referensi (jika ada)
            if ($request->hasFile('references')) {
                foreach ($request->file('references') as $file) {
                    $uploadedPaths[] = $this->fileService->storeImage($file, 'custom_references');
                }
            }

            // 2. Eksekusi database transaction atomik
            $order = DB::transaction(function () use ($validated, $uploadedPaths) {
                // Buat profil customer
                $customer = Customer::create([
                    'name' => $validated['name'],
                    'phone' => $validated['phone'],
                    'address' => $validated['address'],
                ]);

                // Generate kode unik BLM-YYYYMM-XXXX
                $orderCode = $this->codeGenerator->generate();

                // Buat order master dengan status awal ST-04 (Menunggu Konfirmasi Harga)
                $order = Order::create([
                    'order_code' => $orderCode,
                    'customer_id' => $customer->id,
                    'order_type' => 'custom',
                    'total_amount' => 0.00, // Menunggu penetapan oleh florist
                    'current_status' => 'ST-04',
                    'delivery_date' => $validated['delivery_date'],
                    'greeting_card_message' => $validated['greeting_card_message'] ?? null,
                    'note' => $validated['custom_note'] ?? null,
                ]);

                // Buat spesifikasi custom request
                $customRequest = CustomRequest::create([
                    'order_id' => $order->id,
                    'flower_type_preference' => $validated['flower_type_preference'] ?? null,
                    'color_scheme' => $validated['color_scheme'] ?? null,
                    'wrapping_type' => $validated['wrapping_type'] ?? null,
                    'event_theme' => $validated['event_theme'] ?? null,
                    'custom_note' => $validated['custom_note'] ?? null,
                    'estimated_budget' => $validated['estimated_budget'] ?? null,
                ]);

                // Simpan referensi berkas
                foreach ($uploadedPaths as $path) {
                    CustomReference::create([
                        'custom_request_id' => $customRequest->id,
                        'file_path' => $path,
                    ]);
                }

                // Catat riwayat status awal
                $this->stateMachine->transition(
                    $order,
                    'ST-04',
                    'Permintaan buket custom diajukan oleh pemesan. Menunggu peninjauan dan penentuan harga oleh Florist.'
                );

                return $order;
            });

            return redirect()->route('custom.success', ['code' => $order->order_code])
                ->with('success', 'Permintaan custom buket Anda berhasil dikirimkan!');

        } catch (\Throwable $e) {
            // Bersihkan berkas yang sempat terunggah jika transaksi gagal
            foreach ($uploadedPaths as $path) {
                $this->fileService->deleteImage($path);
            }
            throw $e;
        }
    }

    /**
     * Halaman Konfirmasi Tiket Custom Berhasil Dibuat
     */
    public function success(string $code)
    {
        $order = Order::with(['customer', 'customRequest.references'])
            ->where('order_code', $code)
            ->firstOrFail();

        return view('customer.custom.success', compact('order'));
    }
}

