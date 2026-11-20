<?php

namespace App\Services;

use App\Models\Order;

class WhatsAppLinkGeneratorService
{
    /**
     * Menghasilkan tautan konfirmasi pesanan dari pelanggan ke Florist
     */
    public function generateCustomerOrderLink(Order $order): string
    {
        $phone = config('app.bloome_whatsapp_number', env('BLOOME_WHATSAPP_NUMBER', '6281255554321'));
        $totalFormatted = 'Rp ' . number_format($order->total_amount, 0, ',', '.');
        
        $message = "Halo Florist BLOOMÉ Samarinda! 🌸\n\n"
            . "Saya ingin mengonfirmasi pesanan buket saya:\n"
            . "• Kode Pesanan: *{$order->order_code}*\n"
            . "• Nama Pemesan: {$order->customer->name}\n"
            . "• Tanggal Kebutuhan: {$order->delivery_date->format('d/m/Y')}\n"
            . "• Total Tagihan: {$totalFormatted}\n\n"
            . "Mohon info status dan arahan pembayarannya. Terima kasih!";

        return 'https://wa.me/' . $phone . '?text=' . urlencode($message);
    }

    /**
     * Menghasilkan tautan penawaran harga custom dari Florist ke Pelanggan
     */
    public function generatePriceOfferLink(Order $order, float $agreedPrice): string
    {
        // Nomor pelanggan
        $customerPhone = preg_replace('/[^0-9]/', '', $order->customer->phone);
        if (str_starts_with($customerPhone, '0')) {
            $customerPhone = '62' . substr($customerPhone, 1);
        }

        $priceFormatted = 'Rp ' . number_format($agreedPrice, 0, ',', '.');
        $payUrl = route('payment.create', ['order_code' => $order->order_code]);

        $message = "Halo Kak {$order->customer->name}! 🌸\n\n"
            . "Terima kasih telah mengajukan pesanan buket custom di *BLOOMÉ Samarinda*.\n"
            . "Permintaan buket custom Anda (*{$order->order_code}*) telah kami tinjau dengan seksama.\n\n"
            . "✨ *Estimasi Harga Penawaran Florist:* *{$priceFormatted}*\n\n"
            . "Untuk melanjutkan proses pembuatan buket, silakan lakukan pembayaran dan unggah bukti transfer melalui tautan berikut:\n"
            . "{$payUrl}\n\n"
            . "Salam hangat,\n*Nabila Febriyani — BLOOMÉ Florist*";

        return 'https://wa.me/' . $customerPhone . '?text=' . urlencode($message);
    }

    /**
     * Menghasilkan tautan notifikasi buket selesai siap diambil/dikirim
     */
    public function generateOrderReadyLink(Order $order): string
    {
        $customerPhone = preg_replace('/[^0-9]/', '', $order->customer->phone);
        if (str_starts_with($customerPhone, '0')) {
            $customerPhone = '62' . substr($customerPhone, 1);
        }

        $message = "Halo Kak {$order->customer->name}! 🌸\n\n"
            . "Kabar gembira! Rangkaian buket bunga Anda (*{$order->order_code}*) telah selesai dirangkai dengan indah oleh florist kami dan *SIAP DIAMBIL / DIKIRIM*.\n\n"
            . "Lokasi Butik BLOOMÉ:\n"
            . "Jalan Cipto Mangunkusumo, Simpang Tiga, Loa Janan Ilir, Samarinda.\n\n"
            . "Terima kasih telah mempercayakan momen berharga Anda bersama BLOOMÉ!";

        return 'https://wa.me/' . $customerPhone . '?text=' . urlencode($message);
    }
}

