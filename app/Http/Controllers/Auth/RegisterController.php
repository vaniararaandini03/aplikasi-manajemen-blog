<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Tampilkan form register
    public function showRegistrationForm()
    {
        return view('auth.register'); // nanti di form ada field name, email, password
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:staff,admin',
        ]);

        // Buat user baru dengan role yang dipilih
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Setelah register, arahkan ke login
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silakan login.');
    }
}
