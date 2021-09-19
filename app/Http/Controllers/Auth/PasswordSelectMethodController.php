<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordSelectMethodController extends Controller
{
    //
    public function index()
    {
        return view('auth.forgot-password-select');
    }

    public function store(Request $request)
    {
        $method = $request->method;

        if(empty($method)) {
            return back()->with('fail', 'You must select a password reset method!');
        }   else if ($method == 'email') {
            return redirect()->route('password.request-email');
        }   
    }
}
