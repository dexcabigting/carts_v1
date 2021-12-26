<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'region',
        'province',
        'city',
        'barangay',
        'home_address',
        'is_main_address',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'region' => 'No address yet',
            'province' => 'No address yet',
            'city' => 'No address yet',
            'barangay' => 'No address yet',
            'home_address' => 'No address yet',
            'is_main_address' => 'No address yet',
        ]);
    }
}
