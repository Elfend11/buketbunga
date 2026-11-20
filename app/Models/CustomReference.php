<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomReference extends Model
{
    protected $table = 'custom_references';

    protected $fillable = [
        'custom_request_id',
        'file_path',
    ];

    public function customRequest(): BelongsTo
    {
        return $this->belongsTo(CustomRequest::class, 'custom_request_id');
    }
}

