<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalArticles   = \App\Models\Article::count();
        $totalUsers      = \App\Models\User::count();
        $totalCategories = \App\Models\Category::count();
        $recentArticles  = \App\Models\Article::with('user','category')
                                ->latest()
                                ->take(5)
                                ->get();

        return view('admin.dashboard', compact(
            'totalArticles',
            'totalUsers',
            'totalCategories',
            'recentArticles'
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
