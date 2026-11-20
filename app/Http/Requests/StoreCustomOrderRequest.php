<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Rules untuk formulir buket kustom & unggah foto referensi (Maks 3 foto, <= 5MB)
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s]+$/'],
            'address' => ['required', 'string', 'max:500'],
            'delivery_date' => ['required', 'date', 'after:today'],
            'estimated_budget' => ['nullable', 'numeric', 'min:10000'],
            'flower_type_preference' => ['nullable', 'string', 'max:150'],
            'color_scheme' => ['nullable', 'string', 'max:100'],
            'wrapping_type' => ['nullable', 'string', 'max:100'],
            'event_theme' => ['nullable', 'string', 'max:100'],
            'custom_note' => ['nullable', 'string', 'max:1000'],
            'greeting_card_message' => ['nullable', 'string', 'max:250'],
            'references' => ['nullable', 'array', 'max:3'],
            'references.*' => ['file', 'mimes:jpeg,jpg,png', 'max:5120'], // Max 5MB per gambar
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap pemesan wajib diisi.',
            'phone.required' => 'Nomor WhatsApp aktif wajib diisi.',
            'address.required' => 'Alamat pengiriman di Kota Samarinda wajib diisi.',
            'delivery_date.after' => 'Tanggal kebutuhan buket minimal H+1.',
            'references.max' => 'Anda maksimal dapat mengunggah hingga 3 foto referensi.',
            'references.*.mimes' => 'Format foto referensi hanya boleh JPG atau PNG.',
            'references.*.max' => 'Ukuran masing-masing foto referensi maksimal 5MB.',
        ];
    }
}

