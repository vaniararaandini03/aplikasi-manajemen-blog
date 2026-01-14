<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Article;

class StaffDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $totalArticles = Article::where('user_id', $userId)->count();

        $publishedArticles = Article::where('user_id', $userId)
            ->where('status', 'published')
            ->count();

        $draftArticles = Article::where('user_id', $userId)
            ->where('status', 'draft')
            ->count();

        // ✅ DATA UNTUK CHART.JS
        $chartData = [
            'labels' => ['Published', 'Draft'],
            'values' => [$publishedArticles, $draftArticles],
        ];

        return view('staff.dashboard.index', compact(
            'totalArticles',
            'publishedArticles',
            'draftArticles',
            'chartData'
        ));
    }
}
