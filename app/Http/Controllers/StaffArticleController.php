<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffArticleController extends Controller
{
    public function index()
    {
        $articles = Article::where('user_id', Auth::id())
            ->latest()
            ->paginate(5);

        return view('staff.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('staff.articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5',
            'content' => 'required',
            'thumbnail' => 'nullable|image|max:2048'
        ]);

        $thumbnail = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail')->store('thumbnails');
        }

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'thumbnail' => $thumbnail,
            'status' => 'draft',
            'user_id' => Auth::id()
        ]);

        return redirect()->route('staff.articles.index')
            ->with('success', 'Artikel berhasil dibuat');
    }

    public function edit(Article $article)
    {
        abort_if($article->user_id !== Auth::id(), 403);
        return view('staff.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        abort_if($article->user_id !== Auth::id(), 403);

        $request->validate([
            'title' => 'required|min:5',
            'content' => 'required'
        ]);

        $article->update($request->only('title','content'));

        return redirect()->route('staff.articles.index')
            ->with('success', 'Artikel diperbarui');
    }

    public function destroy(Article $article)
    {
        abort_if($article->user_id !== Auth::id(), 403);

        $article->delete();

        return back()->with('success', 'Artikel dihapus');
    }
}
