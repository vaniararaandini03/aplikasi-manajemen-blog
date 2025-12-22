<?php

namespace App\Http\Controllers;

// Tambahkan di class AdminController

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    // Method untuk menampilkan form buat staff baru
    public function createStaff()
    {
        return view('admin.create-staff');
    }

    // Method untuk menyimpan staff baru
    public function storeStaff(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff', // role staff
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Staff baru berhasil dibuat.');
    }
}
