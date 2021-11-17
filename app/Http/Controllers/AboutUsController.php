<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAddress;
use App\Models\Fabric;
use App\Models\Category;

class AboutUsController extends Controller
{
    //
    public function index()
    {
        $admin = UserAddress::where('user_id', 1)
                    ->with('user')
                    ->first();

        $fabrics = Fabric::select('fab_name')->get();

        $categories = Category::select('ctgr_name')->get();

        return view('about-us', compact('admin', 'fabrics', 'categories'));
    }
}
