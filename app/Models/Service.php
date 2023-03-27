<?php

namespace App\Models;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'boj',
        'code',
        'hizmat',
        'kogaz'
    ];

    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = [
        'resource_url'
    ];

    public static function boot(): void
    {
        parent::boot();

        self::created(static function ($model){
            $model->code = 'SRV' . $model->id;
        });
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function getResourceUrlAttribute(): string|UrlGenerator|Application
    {
        return url('/admin/services/'.$this->getKey());
    }
}
