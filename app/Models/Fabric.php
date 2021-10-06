<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabric extends Model
{
    use HasFactory;

    protected $with = ['product'];

    protected $fillable = [
        'fab_name',
        'fab_description',
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
