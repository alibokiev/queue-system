<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceCenter extends Model
{
    protected $fillable = [
        'name',
        'address'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
