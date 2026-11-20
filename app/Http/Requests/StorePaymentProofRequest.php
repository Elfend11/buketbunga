<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentProofRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payment_method' => ['required', 'string', 'in:BCA,Mandiri,Dana,Transfer Bank Lain'],
            'amount_paid' => ['required', 'numeric', 'min:1000'],
            'proof_file' => ['required', 'file', 'mimes:jpeg,jpg,png', 'max:5120'], // Max 5MB
        ];
    }

    public function messages(): array
    {
        return [
            'payment_method.required' => 'Pilih rekening/metode pembayaran yang Anda gunakan.',
            'amount_paid.required' => 'Masukkan nominal dana yang ditransfer.',
            'proof_file.required' => 'Unggah foto struk atau screenshot bukti transfer bank.',
            'proof_file.mimes' => 'Bukti transfer hanya boleh berupa berkas gambar JPG atau PNG.',
            'proof_file.max' => 'Ukuran berkas bukti transfer tidak boleh melebihi 5MB.',
        ];
    }
}

