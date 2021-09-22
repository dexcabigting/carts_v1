<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class OTPController extends Controller
{
    /**
     * Display the password reset view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function create(User $user, $shown_token)
    {
        // $shown_token = $request->token;

        $token = session('token');

        $hash = sha1($token.$user->id.$token);

        if($hash == $shown_token) {
            return view('auth.otp-verification', compact('user'));
        } else {
            abort("404");
        }  
    }

    public function store(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();

        $user_otp = $user->otp;

        if($request->otp == $user_otp) {
            $user->otp = '';

            $token = Password::createToken($user);

            $email = $user->email;

            return redirect()->route('password.reset', [$token.'?email='.$email]);
        } else {

        }
    }
}
