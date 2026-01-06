<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    // Halaman daftar kategori
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    // Halaman artikel berdasarkan kategori
    public function show(Category $category)
    {
        $articles = $category->articles()->with('author')->get();

        return view('admin.categories.show', compact('category', 'articles'));
    }
}
