<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetCustomPriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Divalidasi oleh auth:admin middleware
    }

    public function rules(): array
    {
        return [
            'agreed_price' => ['required', 'numeric', 'min:10000'],
            'admin_notes' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'agreed_price.required' => 'Nominal harga penawaran buket kustom wajib ditentukan.',
            'agreed_price.min' => 'Nominal harga minimal Rp 10.000.',
        ];
    }
}

