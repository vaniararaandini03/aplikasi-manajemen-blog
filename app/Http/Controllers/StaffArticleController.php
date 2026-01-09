<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffArticleController extends Controller
{
    // LIST ARTIKEL STAFF
    public function index()
    {
        $articles = Article::where('user_id', Auth::id())
            ->with('category')
            ->latest()
            ->paginate(6);

        return view('staff.articles.index', compact('articles'));
    }

    // FORM TAMBAH
    public function create()
    {
        $categories = Category::all();
        return view('staff.articles.create', compact('categories'));
    }

    // SIMPAN
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content'     => 'required|min:100',
        ]);

        Article::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'author'      => $request->author,
            'category_id' => $request->category_id,
            'content'     => $request->content,
            'status'      => 'draft', // 🔥 staff default draft
        ]);

        return redirect()
            ->route('staff.articles.index')
            ->with('success', 'Artikel berhasil dibuat (Draft)');
    }

    // DETAIL
    public function show(Article $article)
    {
        abort_if($article->user_id !== Auth::id(), 403);
        return view('staff.articles.show', compact('article'));
    }

    // FORM EDIT
    public function edit(Article $article)
    {
        abort_if($article->user_id !== Auth::id(), 403);
        $categories = Category::all();

        return view('staff.articles.edit', compact('article', 'categories'));
    }

    // UPDATE
    public function update(Request $request, Article $article)
    {
        abort_if($article->user_id !== Auth::id(), 403);

        $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content'     => 'required|min:100',
        ]);

        $article->update($request->only(
            'title',
            'author',
            'category_id',
            'content'
        ));

        return redirect()
            ->route('staff.articles.index')
            ->with('success', 'Artikel berhasil diperbarui');
    }

    // HAPUS
    public function destroy(Article $article)
    {
        abort_if($article->user_id !== Auth::id(), 403);
        $article->delete();

        return back()->with('success', 'Artikel berhasil dihapus');
    }
}
