<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'number',
        'comment',
        'category_id',
        'status_id',
        'client_id',
        'user_id',
        'created_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * @param Category $category
     * @return string
     */
    public static function getNumber(Category $category)
    {
        $today = Carbon::now()->toDateString();

        $count = Ticket::where('created_at', '>=', $today)
            ->whereCategoryId($category->id)
            ->count();

        $key = mb_substr($category->name, 0, 1, "UTF-8");
        $count++;

        return "{$key}-{$count}";
    }

    public static function getTodays()
    {
        $today = Carbon::now()->toDateString();

        $count = Ticket::where('created_at', '>=', $today)->count();

        return $count;
    }

    public static function getTodaysByUser($user)
    {
        $today = Carbon::now()->toDateString();

        $count = Ticket::where('created_at', '>=', $today)
            ->where('user_id', $user->id)
            ->count();

        return $count;
    }

}
