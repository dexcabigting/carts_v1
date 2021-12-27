<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class OrderVariant extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['order_items'];

    protected $fillable = [
        'order_id',
        'product_variant_id',
        'amount'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'earliest',
        'latest'
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
