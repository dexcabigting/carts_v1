<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    protected $fillable = [
        'user_id',
        'product_variant_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $cascadeDeletes = ['cart_items'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product_variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function cart_items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function cartItemSizes()
    {
        return $this->hasMany(CartItem::class)->pluck('size')->countBy();
    }
}
