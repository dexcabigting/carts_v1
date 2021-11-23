<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_variant_id',
        'amount',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product_variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function variant_total()
    {
        return $this->amount * $this->order_items()->count();
    }
}
