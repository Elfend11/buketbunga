<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCatalogOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Guest order terbuka untuk umum
    }

    /**
     * Get the validation rules that apply to the request.
     * Task ID: BE-009 / BR-004 (Minimal H+1)
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s]+$/'],
            'address' => ['required', 'string', 'max:500'],
            'delivery_date' => ['required', 'date', 'after:today'], // Minimal H+1
            'greeting_card_message' => ['nullable', 'string', 'max:250'],
            'note' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap pemesan wajib diisi.',
            'phone.required' => 'Nomor WhatsApp aktif wajib diisi agar florist dapat menghubungi Anda.',
            'address.required' => 'Alamat pengiriman di Kota Samarinda wajib dicantumkan.',
            'delivery_date.required' => 'Pilih tanggal kebutuhan buket bunga.',
            'delivery_date.after' => 'Tanggal kebutuhan minimal H+1 (satu hari setelah hari pemesanan).',
            'greeting_card_message.max' => 'Pesan kartu ucapan maksimal 250 karakter.',
        ];
    }
}

