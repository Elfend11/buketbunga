<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'string', 'in:ST-01,ST-02,ST-03,ST-04,ST-05,ST-06,ST-07,ST-08'],
            'notes' => ['nullable', 'string', 'max:500'],
        ];
    }
}

