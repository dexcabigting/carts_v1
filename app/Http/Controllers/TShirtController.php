<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TshirtDetails;

class TShirtController extends Controller
{
    //
    public function store(Request $request)
    {
        TshirtDetails::create([
            'user_id' => $request['customer_name'],
            'tshirt_front' => $request['tshirt_front'],
            'tshirt_back' => $request['tshirt_back'],
            'tshirt_jersey_measurements' => $request['tshirt_jersey_measurements'],
            'tshirt_short_measurements' => $request['tshirt_short_measurements'],
            'tshirt_fabric' => $request['tshirt_fabric'],
            'tshirt_type' => $request['tshirt_type'],
            'tshirt_color' => $request['tshirt_color'],
            'tshirt_pdf' => $request['tshirt_pdf'],
            'is_approve' => false,
        ]);
    }

    public function update(Request $request)
    {
        TshirtDetails::where('id', $request['id'])
            ->update([
                'custom_note' => $request['custom_note'],
                'custom_price' => $request['custom_price'],
                'custom_estimate_delivery' => $request['custom_estimate_delivery'],
                'is_approve' => true
            ]);
    }
}
