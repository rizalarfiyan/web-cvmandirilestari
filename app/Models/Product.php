<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'images',
        'price',
        'in_stock',
        'is_featured',
        'on_sale',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
