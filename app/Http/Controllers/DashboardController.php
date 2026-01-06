<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
{
    return view('admin.dashboard', [
        // Statistik
        'totalArticles'     => Article::count(),
        'publishedArticles' => Article::where('status', 'published')->count(),
        'draftArticles'     => Article::where('status', 'draft')->count(),
        'totalUsers'        => User::count(),

        // List artikel
        'articles'     => Article::latest()->take(6)->get(),
        'editorChoice' => Article::latest()->take(5)->get(),
    ]);
}

}
