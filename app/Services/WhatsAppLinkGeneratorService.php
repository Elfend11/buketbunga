<?php

namespace App\Services;

use App\Models\BusinessSetting;
use App\Models\Order;
use App\Models\Product;

class WhatsAppLinkGeneratorService
{
    private function getDestinationPhone(): ?string
    {
        $phone = BusinessSetting::get('whatsapp_number');

        if (!$phone) {
            $phone = env('BLOOME_WHATSAPP_NUMBER');
        }

        if (!is_string($phone) || trim($phone) === '') {
            return null;
        }

        $phone = preg_replace('/[^0-9]/', '', trim($phone));

        if ($phone === '' || str_starts_with($phone, '0')) {
            return $phone && str_starts_with($phone, '0')
                ? '62' . substr($phone, 1)
                : null;
        }

        return $phone;
    }

    public function generateCatalogOrderLink(
        Product $product,
        array $optionNames,
        array $addOnNames,
        float $estimatedTotal,
        ?string $note = null
    ): ?string {
        $phone = $this->getDestinationPhone();
        if (!$phone) {
            return null;
        }

        $lines = [
            'Halo BLOOMÉ Samarinda!',
            '',
            'Saya tertarik memesan buket:',
            "*{$product->name}*",
            'Estimasi harga: Rp ' . number_format($estimatedTotal, 0, ',', '.'),
        ];

        if ($optionNames !== []) {
            $lines[] = 'Personalisasi:';
            foreach ($optionNames as $name) {
                $lines[] = '- ' . $name;
            }
        }

        if ($addOnNames !== []) {
            $lines[] = 'Add-on:';
            foreach ($addOnNames as $name) {
                $lines[] = '- ' . $name;
            }
        }

        if ($note) {
            $lines[] = 'Catatan: ' . $note;
        }

        $lines[] = '';
        $lines[] = 'Mohon konfirmasi ketersediaan, harga akhir, pembayaran, dan pengiriman. Terima kasih.';

        return 'https://wa.me/' . $phone . '?text=' . urlencode(implode("\n", $lines));
    }

    /**
     * Menghasilkan tautan konfirmasi pesanan dari pelanggan ke Florist
     */
    public function generateCustomerOrderLink(Order $order): string
    {
        $phone = $this->getDestinationPhone();
        if (!$phone) {
            return '';
        }
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

