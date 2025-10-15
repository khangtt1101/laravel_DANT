<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'full_name', 'email', 'password', 'phone_number', 'address', 'role',
    ];

    protected $hidden = [ 'password', 'remember_token', ];

    protected function casts(): array {
        return ['email_verified_at' => 'datetime', 'password' => 'hashed', ];
    }

    // Một User có nhiều Orders
    public function orders() {
        return $this->hasMany(Order::class);
    }

    // Một User có nhiều Reviews
    public function reviews() {
        return $this->hasMany(Review::class);
    }
}