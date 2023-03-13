<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Client extends Model
{
    protected $fillable = [
        'phone',
        'surname',
        'name',
        'second_name',
        'tin',
        'passport',
        'address',
        'date_of_birth',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $appends = ['resource_url', 'full_name', 'common_name'];

    public $timestamps = true;

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/clients/' . $this->getKey());
    }

    public function getFullNameAttribute()
    {
        $fullName = $this->surname . " " . $this->name . " " . $this->second_name;
        return trim($fullName) != "" ? trim($fullName) : "Клиент (ФИО не указано)";
    }

    public function getCommonNameAttribute()
    {
        $fullName = $this->surname . " " . Str::substr($this->name, 0, 1) . ". " . Str::substr($this->second_name, 0, 1) . ".";
        return trim($fullName) != ". ." ? trim($fullName) : "Новый ({$this->phone})";
    }
}
