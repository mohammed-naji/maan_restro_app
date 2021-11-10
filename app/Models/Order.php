<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function meals()
    {
        return $this->belongsToMany(Meal::class)
        ->withPivot('quantity')
        ->as('items');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['name' => '']);
    }

    public function waiter()
    {
        return $this->belongsTo(User::class, 'waiter_id');
    }

    public function cacher()
    {
        return $this->belongsTo(User::class, 'cacher_id');
    }
}
