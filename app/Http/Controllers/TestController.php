<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Address\Entities\Region;
use Yajra\Address\Entities\Province;

class TestController extends Controller
{
    //
    public function index()
    {
        // $regions = Region::get(['name', 'region_id'])->toArray();

        $provinces = Province::get(['name', 'region_id', 'province_id'])->toArray();

        dd($provinces);

        return view('test');
    }
}
