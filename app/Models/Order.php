<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Một Order thuộc về một User
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Một Order có nhiều OrderItems
    public function items() {
        return $this->hasMany(OrderItem::class);
    }
}