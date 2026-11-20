<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AddOn extends Model
{
    protected $table = 'add_ons';

    protected $fillable = [
        'name',
        'price',
        'description',
        'image_path',
        'is_available',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'product_add_ons',
            'add_on_id',
            'product_id'
        )->withTimestamps();
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }
}

