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
            ->simplePaginate(6);

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
            'author'      => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content'     => [
                'required',
                function ($attribute, $value, $fail) {
                    if (str_word_count(strip_tags($value)) < 100) {
                        $fail('Isi artikel minimal 100 kata');
                    }
                }
            ],
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        Article::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'author'      => $request->author,
            'category_id' => $request->category_id,
            'content'     => $request->content,
            'image'       => $imagePath,
            'status'      => 'published',
        ]);

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Artikel berhasil ditambahkan');
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
            'category_id' => 'required|exists:categories,id',
            'content'     => [
                'required',
                function ($attribute, $value, $fail) {
                    if (str_word_count(strip_tags($value)) < 100) {
                        $fail('Isi artikel minimal 100 kata');
                    }
                }
            ],
            'status' => 'required|in:draft,published',
        ]);

        $article->update($request->only(
            'title','author','category_id','content','status'
        ));

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diperbarui');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return back()->with('success', 'Artikel berhasil dihapus');
    }
}
