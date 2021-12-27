<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    protected $table = 'products';

    protected $cascadeDeletes = ['product_variants', 'likes'];

    protected $fillable = [
        'category_id',
        'fabric_id',
        'prd_name',
        'prd_description',
        'prd_price'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
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

    public function isAuthUserLikedProduct()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }
}
