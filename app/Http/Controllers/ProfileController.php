<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateCredentialsRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateAddressRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $userAddress = auth()->user()->addresses()->where('is_main_address', 1)->first();

        return view('profile.index', compact('userAddress'));
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

    public function update_address(UpdateAddressRequest $request)
    {
        $userAddress = auth()->user()->addresses()->where('is_main_address', 1)->first();

        if($userAddress) {
            $userAddress->update($request->only('region', 'province', 'city', 'barangay', 'home_address', 'is_main_address'));
        } else {
            $newUserAddress = auth()->user()->addresses()->create($request->only('region', 'province', 'city', 'barangay', 'home_address'));
            $newUserAddress->is_main_address = 1;
            $newUserAddress->save();
        }
        

        return redirect()->route('profile.index')->with('success', 'Address updated successfully!');
    }
}
