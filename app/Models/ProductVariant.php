<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class ProductVariant extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['product_stock', 'carts', 'order_variants', 'product_variant_comments'];

    protected $fillable = [
        'product_id',
        'prd_var_name',
        'front_view',
        'back_view'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function product_stock()
    {
        return $this->hasOne(ProductStock::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function userHasVariantInCart()
    {
        return $this->carts()->where('user_id', auth()->id())->exists();
    }

    public function order_variants()
    {
        return $this->hasMany(OrderVariant::class);
    }

    public function product_variant_comments()
    {
        return $this->hasMany(ProductVariantComment::class);
    }
}
