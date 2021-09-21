<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PregReplaceTestController extends Controller
{
    //
    public function index()
    {
        $phone = "";
        return view('test.preg_replace', compact('phone'));
    }

    public function replace(Request $request)
    {
        $phone = $request->input('phone');

        $phone = preg_replace( '/^(09)(\d+)/', '639$2', $phone);

        return view('test.preg_replace', compact('phone'));
    }
}
