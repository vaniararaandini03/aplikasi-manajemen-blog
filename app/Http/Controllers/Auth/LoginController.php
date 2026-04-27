<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek apakah akun terdaftar
        if (!User::where('email', $request->email)->exists()) {
            return back()
                ->withErrors(['email' => 'Akun belum terdaftar'])
                ->withInput();
        }

        // Cek password
        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()
                ->withErrors(['password' => 'Password yang Anda masukkan salah'])
                ->withInput();
        }

        // Login berhasil
        $request->session()->regenerate();

        // Redirect sesuai role
        return match (auth()->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'staff' => redirect()->route('staff.articles.index'),
            'guest' => redirect()->route('home'),
            default => redirect()->route('login')
                ->withErrors(['email' => 'Role tidak dikenali']),
        };
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
