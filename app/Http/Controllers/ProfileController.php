<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateCredentialsRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function update_credentials(UpdateCredentialsRequest $request)
    {
        $phone = preg_replace( '/^(09)(\d+)/', '639$2', $request->input('phone'));

        $request->offsetSet('phone', $phone);

        auth()->user()->update($request->only('name', 'email', 'phone'));

        return redirect()->route('profile.index')->with('success', 'Credentials updated successfully!');
    } 

    public function update_password(UpdatePasswordRequest $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('fail', 'Your current password does not match our records!');
        }

        $user->update([
            'password' => Hash::make($request->new_password)
            ]);

        return redirect()->route('profile.index')->with('success', 'Password updated successfully!');
    }
}
