<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'prd_var_name',
        'front_view',
        'back_view',
        'left_view',
        'right_view',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
