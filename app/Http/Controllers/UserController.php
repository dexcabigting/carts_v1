<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    
    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function edit(User $user)
    {   
        return view('users.edit', compact('user'));
    }
}
