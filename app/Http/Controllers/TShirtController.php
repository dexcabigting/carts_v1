<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TshirtDetails;

class TShirtController extends Controller
{
    //
    public function store(Request $request)
    {
        $currentDate = date("Y-m-d");

        TshirtDetails::create([
            'customer_name' => $request['customer_name'],
            'tshirt_front' => $request['tshirt_front'],
            'tshirt_back' => $request['tshirt_back'],
            'tshirt_jersey_measurements' => $request['tshirt_jersey_measurements'],
            'tshirt_short_measurements' => $request['tshirt_short_measurements'],
            'tshirt_fabric' => $request['tshirt_fabric'],
            'tshirt_type' => $request['tshirt_type'],
            'tshirt_color' => $request['tshirt_color'],
            'tshirt_pdf' => $request['tshirt_pdf'],
            'created_date' => $currentDate,
            'updated_date' => $currentDate,
        ]);

        session()->flash('success', 'User has been created successfully!'); 
    }

}
