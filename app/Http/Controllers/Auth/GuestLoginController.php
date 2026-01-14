<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.guest-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Akun tidak ditemukan']);
        }

        // 🔒 BLOK ADMIN & STAFF
        if ($user->role !== 'guest') {
            return back()->withErrors([
                'email' => 'Akun ini bukan akun guest'
            ]);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors([
                'password' => 'Password salah'
            ]);
        }

        $request->session()->regenerate();
        return redirect()->route('home');
    }
}
