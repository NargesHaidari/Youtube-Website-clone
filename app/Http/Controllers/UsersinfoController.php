<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usersinfo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersinfoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'age' => 'required|integer|min:1|max:100',
            'email' => 'required|email|unique:usersinfo,email',
            'password' => 'required|min:6',
            'profile' => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $profilePath = $request->file('profile')->store('profiles', 'public');

        $users = Usersinfo::create([
            'name' => $request->name,
            'age' => $request->age,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile' => $profilePath,
        ]);

        return redirect('/login');
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt([
            'email' => $email,
            'password' => $password
        ])) {
            return redirect()->route('youtube');
        }

        return back()->withErrors([
            'email' => 'The email or password is incorrect.'
        ]);
    }
}

