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

        return view('home', [
        'articles' => Article::latest()->get()
    ]);
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

    // Method untuk menampilkan profile admin
    public function profile()
    {
        return view('admin.profile.index');
    }

    // Method untuk update profile admin
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = auth()->user();

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image && Storage::exists('public/' . $user->profile_image)) {
                Storage::delete('public/' . $user->profile_image);
            }

            // Store new image
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $imagePath;
        }

        // Handle remove photo
        if ($request->has('remove_photo')) {
            if ($user->profile_image && Storage::exists('public/' . $user->profile_image)) {
                Storage::delete('public/' . $user->profile_image);
            }
            $user->profile_image = null;
        }

        // Update user data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success', 'Profile berhasil diperbarui.');
    }

    // Method untuk menampilkan daftar users
    public function users()
    {
        $users = User::latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }
}
