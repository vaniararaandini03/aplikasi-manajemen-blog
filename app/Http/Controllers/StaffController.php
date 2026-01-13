<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class StaffDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        return view('staff.dashboard.index', [
            'totalArticles' => Article::where('user_id', $userId)->count(),
            'publishedArticles' => Article::where('user_id', $userId)
                ->where('status', 'published')->count(),
            'draftArticles' => Article::where('user_id', $userId)
                ->where('status', 'draft')->count(),
            'latestArticles' => Article::where('user_id', $userId)
                ->latest()->take(5)->get(),
        ]);
    }
}
