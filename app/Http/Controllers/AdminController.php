<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Method untuk menampilkan dashboard admin
    public function index()
    {
        $totalArticles = Article::count();
        $publishedArticles = Article::where('status', 'published')->count();
        $draftArticles = Article::where('status', 'draft')->count();
        $totalUsers = User::count();
        $articles = Article::latest()->take(6)->get();

        return view('admin.dashboard', compact('totalArticles', 'publishedArticles', 'draftArticles', 'totalUsers', 'articles'));
    }

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

    // Method untuk menampilkan daftar users
    public function users()
    {
        $users = User::latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }
}
