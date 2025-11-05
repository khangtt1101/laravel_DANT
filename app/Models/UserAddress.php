<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAddress extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_line',
        'city',
        'district',
        'phone_number',
        'is_default',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
