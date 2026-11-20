<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomRequest extends Model
{
    protected $table = 'custom_requests';

    protected $fillable = [
        'order_id',
        'flower_type_preference',
        'color_scheme',
        'wrapping_type',
        'event_theme',
        'custom_note',
        'estimated_budget',
        'agreed_price',
    ];

    protected $casts = [
        'estimated_budget' => 'decimal:2',
        'agreed_price' => 'decimal:2',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function references(): HasMany
    {
        return $this->hasMany(CustomReference::class, 'custom_request_id');
    }
}

