<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_variant_id',
        'size',
        'surname',
        'jersey_number',
    ];

    public function order_variant()
    {
        return $this->belongsTo(OrderVariant::class);
    }
}
