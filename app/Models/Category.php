<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
    ];

    /**
     * Một Category có nhiều sản phẩm.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Quan hệ đa cấp: một danh mục có thể có một danh mục cha.
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Quan hệ đa cấp: một danh mục có thể có nhiều danh mục con.
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}