<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    // LIST ARTIKEL
    public function index()
    {
        $articles = Article::with('category')
            ->latest()
            ->paginate(6);

        return view('admin.articles.index', compact('articles'));
    }

    // FORM TAMBAH
    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    // SIMPAN
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content'     => 'required|min:100',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

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

    // ✅ DETAIL (INI YANG SEBELUMNYA BIKIN ERROR)
    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    // FORM EDIT
    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    // UPDATE
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title'           => 'required|string|max:255',
            'category_id'     => 'required|exists:categories,id',
            'content'         => 'required|min:100',
            'status'          => 'required|in:draft,published',
            'is_editor_choice' => 'nullable|boolean',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $updateData = $request->only([
            'title',
            'category_id',
            'content',
            'status',
        ]);

        // Handle is_editor_choice checkbox
        $updateData['is_editor_choice'] = $request->has('is_editor_choice') ? 1 : 0;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($article->image && \Storage::disk('public')->exists($article->image)) {
                \Storage::disk('public')->delete($article->image);
            }

            $updateData['image'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($updateData);

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diperbarui');
    }

    // HAPUS
    public function destroy(Article $article)
    {
        $article->delete();
        return back()->with('success', 'Artikel berhasil dihapus');
    }
}
