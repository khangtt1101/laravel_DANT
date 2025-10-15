<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = []; // Hoặc $fillable = [...]

    /**
     * Tắt tính năng tự động quản lý timestamps (created_at, updated_at).
     */
    public $timestamps = false;
}