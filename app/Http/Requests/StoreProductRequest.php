<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:150'],
            'price' => ['required', 'numeric', 'min:1000'],
            'description' => ['required', 'string', 'max:2000'],
            'image' => ['required', 'file', 'mimes:jpeg,jpg,png,webp', 'max:3072'], // Max 3MB
            'is_available' => ['nullable', 'boolean'],
        ];
    }
}

