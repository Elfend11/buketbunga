<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'price',
        'description',
        'image_path',
        'is_available',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id')->orderBy('sort_order', 'asc');
    }

    public function personalizationOptions(): BelongsToMany
    {
        return $this->belongsToMany(
            PersonalizationOption::class,
            'product_personalization_options',
            'product_id',
            'option_id'
        )->withTimestamps();
    }

    public function addOns(): BelongsToMany
    {
        return $this->belongsToMany(
            AddOn::class,
            'product_add_ons',
            'product_id',
            'add_on_id'
        )->withTimestamps();
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }
}
