<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\Category;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $totalArticles = Article::count();
    $totalUsers = User::count();
    $totalCategories = Category::count();

    // ini yang wajib ada untuk memperbaiki error
    $publishedArticles = Article::where('status', 'published')->count();

    $recentArticles = Article::latest()->take(5)->get();

    return view('admin.dashboard', compact(
        'totalArticles',
        'totalUsers',
        'totalCategories',
        'publishedArticles', // ← ini yang hilang!
        'recentArticles'
    ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
