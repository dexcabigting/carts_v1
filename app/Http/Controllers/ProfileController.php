<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function update(ProfileUpdateRequest $request)
    {
        auth()->user()->update($request->only('name', 'email'));

        if ($request->input('password')) {
            auth()->user()->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('profile.index')->with('message', 'Profile updated successfully!');
    } 
}
