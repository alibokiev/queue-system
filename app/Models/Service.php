<?php

namespace App\Models;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
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
        self::created(static function ($model){
            $model->code = 'SRV' . $model->id;
        });
    }

    public function getResourceUrlAttribute(): string|UrlGenerator|Application
    {
        return url('/admin/services/'.$this->getKey());
    }
}
