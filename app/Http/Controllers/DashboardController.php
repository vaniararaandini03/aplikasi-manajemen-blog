<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik
        $totalArticles = Article::count();
        $published     = Article::where('status', 'published')->count();
        $draft         = Article::where('status', 'draft')->count();
        $totalUsers    = User::count();

        // Artikel terbaru (untuk dashboard)
        $latestArticles = Article::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalArticles',
            'published',
            'draft',
            'totalUsers',
            'latestArticles'
        ));
    }
}
