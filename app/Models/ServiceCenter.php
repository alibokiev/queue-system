<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceCenter extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'address'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
