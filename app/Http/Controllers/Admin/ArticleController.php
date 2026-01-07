<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')
            ->latest()
            ->simplepaginate(6);

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
{
    $request->validate([
        'title'       => 'required|string|max:255',
        'content'     => 'required',
        'category_id' => 'required|exists:categories,id',
    ]);

    Article::create([
        'user_id'     => Auth::id(),
        'title'       => $request->title,
        'category_id' => $request->category_id,
        'content'     => $request->content,
        'status'      => 'published',
    ]);

    return redirect()
        ->route('admin.articles.index')
        ->with('success', 'Artikel berhasil ditambahkan');
}


    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'content'     => 'required',
            'category_id' => 'required|exists:categories,id',
            'status'      => 'required|in:draft,published',
        ]);

        $article->update([
            'title'       => $request->title,
            'author'      => $request->author,
            'content'     => $request->content,
            'category_id' => $request->category_id,
            'status'      => $request->status,
        ]);

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diupdate');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return back()->with('success', 'Artikel berhasil dihapus');
    }
}