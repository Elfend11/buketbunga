<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonalizationValue extends Model
{
    protected $table = 'personalization_values';

    protected $fillable = [
        'option_id',
        'value_name',
        'additional_price',
        'color_hex',
        'is_available',
    ];

    protected $casts = [
        'additional_price' => 'decimal:2',
        'is_available' => 'boolean',
    ];

    public function option(): BelongsTo
    {
        return $this->belongsTo(PersonalizationOption::class, 'option_id');
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }
}

