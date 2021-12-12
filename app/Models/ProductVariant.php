<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'prd_var_name',
        'front_view',
        'back_view',
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
}
