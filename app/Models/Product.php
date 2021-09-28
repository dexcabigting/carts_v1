<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'prd_name',
        'prd_description',
        'prd_price',
        'prd_image',
    ];

    public function product_stock()
    {
        return $this->hasOne(ProductStock::class);
    }

    public function getProductImageUrlAttribute()
    {
        if($this->prd_image && Storage::exists('public/' . $this->prd_image)) {
            return Storage::url('public/' . $this->prd_image);
        }
    }
}
