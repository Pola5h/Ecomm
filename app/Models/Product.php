<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'slug', 'thumbnail', 'category_id', 'brand_id', 'short_description', 'description', 'price', 'discount', 'status', 'featured', 'stock_quantity', 'deleted_at'];

    protected $table = 'products';

    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
