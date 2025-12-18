<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'latest' => Article::latest()->take(6)->get(),
            'categories' => Category::all(),
            'editorChoice' => Article::where('is_editor_choice', true)->take(4)->get(),
        ]);
    }
}
