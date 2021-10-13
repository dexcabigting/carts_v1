<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'fabric_id',
        'prd_name',
        'prd_description',
        'prd_price',
    ];

    public function product_variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function fabric()
    {
        return $this->belongsTo(Fabric::class);
    }

    public function product_stocks()
    {
        return $this->hasManyThrough(ProductStock::class, ProductVariant::class);
    }

    public function likes()
    {
        return $this->hasMany(ProductLike::class);
    }

    // public function getProductImageUrlAttribute()
    // {
    //     if($this->prd_image && Storage::exists('public/' . $this->prd_image)) {
    //         return Storage::url('public/' . $this->prd_image);
    //     }
    // }

    // public function getProductModelUrlAttribute()
    // {
    //     if($this->prd_3d && Storage::exists('public/' . $this->prd_3d)) {
    //         return Storage::url('public/' . $this->prd_3d);
    //     }
    // }
}
