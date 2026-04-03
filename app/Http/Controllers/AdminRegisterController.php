<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminRegisterController extends Controller
{
    public function show(string $token)
    {
        // Check if admin already exists
        $adminExists = User::count() > 0;

        return view('auth.admin-register', [
            'token'       => $token,
            'adminExists' => $adminExists,
        ]);
    }

    public function store(Request $request, string $token)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()],
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/admin')->with('success', 'Admin account created successfully. Please log in.');
    }
}
