<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PersonalizationOption extends Model
{
    protected $table = 'personalization_options';

    protected $fillable = [
        'name',
        'type',
        'is_required',
    ];

    protected $casts = [
        'is_required' => 'boolean',
    ];

    public function values(): HasMany
    {
        return $this->hasMany(PersonalizationValue::class, 'option_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'product_personalization_options',
            'option_id',
            'product_id'
        )->withTimestamps();
    }
}

