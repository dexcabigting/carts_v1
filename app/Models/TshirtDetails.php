<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TshirtDetails extends Model
{
    use HasFactory;

    protected $table = 'tshirt_details';

    protected $fillable = [
        'user_id',
        'tshirt_front',
        'tshirt_back',
        'tshirt_jersey_measurements',
        'tshirt_short_measurements',
        'tshirt_fabric',
        'tshirt_type',
        'tshirt_color',
        'tshirt_pdf',
        'custom_price',
        'is_approve',
        'custom_note',
        'custom_estimate_delivery',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    protected $casts = [
        'tshirt_front' => 'string',
        'tshirt_back' => 'string',
        'tshirt_jersey_measurements' => 'string',
        'tshirt_short_measurements' => 'string',
        'tshirt_fabric' => 'string',
        'tshirt_type' => 'string',
        'tshirt_type' => 'string',
        'tshirt_pdf' => 'string',
        'custom_price' => 'float',
        'is_approve' => 'boolean',
        'custom_note' => 'string',
        'custom_estimate_delivery' => 'date',
        'created_date' => 'date',
        'updated_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
