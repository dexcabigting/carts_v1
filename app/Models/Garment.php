<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garment extends Model
{
    use HasFactory;

    protected $with = ['product'];

    protected $fillable = [
        'grm_name',
        'grm_description',
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
