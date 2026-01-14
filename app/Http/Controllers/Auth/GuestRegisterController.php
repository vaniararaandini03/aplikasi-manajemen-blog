<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuestRegisterController extends Controller
{
    // Tampilkan form register guest
    public function showRegistrationForm()
    {
        return view('auth.guest-register');
    }

    // Proses register guest
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Buat user baru dengan role guest
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'guest', // Otomatis guest
        ]);

        // Setelah register, arahkan ke guest login
        return redirect()->route('guest.login')->with('success', 'Akun berhasil dibuat, silakan login.');
    }
}
