<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffArticleController extends Controller
{
    // ===============================
    // LIST ARTIKEL STAFF
    // ===============================
    public function index()
    {
        $articles = Article::where('user_id', Auth::id())
            ->with('category')
            ->latest()
            ->paginate(6);

        return view('staff.articles.index', compact('articles'));
    }

    // ===============================
    // FORM TAMBAH
    // ===============================
    public function create()
    {
        $categories = Category::all();
        return view('staff.articles.create', compact('categories'));
    }

    // ===============================
    // SIMPAN (GAMBAR WAJIB)
    // ===============================
    public function store(Request $request)
    {
        $request->validate(
            [
                'title'       => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'content'     => 'required|min:100',
                'status'      => 'required|in:draft,published',
                'image'       => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ],
            [
                'title.required'       => 'Judul artikel wajib diisi.',
                'category_id.required' => 'Kategori wajib dipilih.',
                'content.required'     => 'Isi artikel wajib diisi.',
                'content.min'          => 'Isi artikel minimal 100 kata.',
                'status.required'      => 'Status artikel wajib dipilih.',
                'image.required'       => 'Gambar artikel wajib diunggah.',
                'image.image'          => 'File harus berupa gambar.',
                'image.mimes'          => 'Format gambar harus JPG atau PNG.',
                'image.max'            => 'Ukuran gambar maksimal 2MB.',
            ]
        );

        Article::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'author'      => Auth::user()->name, // otomatis
            'category_id' => $request->category_id,
            'content'     => $request->content,
            'status'      => $request->status,
            'image'       => $request->file('image')->store('articles', 'public'),
        ]);

        return redirect()
            ->route('staff.articles.index')
            ->with('success', 'Artikel berhasil disimpan');
    }

    // ===============================
    // LIHAT DETAIL ARTIKEL
    // ===============================
    public function show(Article $article)
    {
        abort_if($article->user_id !== Auth::id(), 403);

        return view('staff.articles.show', compact('article'));
    }

    // ===============================
    // FORM EDIT
    // ===============================
    public function edit(Article $article)
    {
        abort_if($article->user_id !== Auth::id(), 403);

        $categories = Category::all();
        return view('staff.articles.edit', compact('article', 'categories'));
    }

    // ===============================
    // UPDATE (GAMBAR OPSIONAL)
    // ===============================
    public function update(Request $request, Article $article)
    {
        abort_if($article->user_id !== Auth::id(), 403);

        $request->validate(
            [
                'title'       => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'content'     => 'required|min:100',
                'status'      => 'required|in:draft,published',
                'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ],
            [
                'title.required'       => 'Judul artikel wajib diisi.',
                'category_id.required' => 'Kategori wajib dipilih.',
                'content.required'     => 'Isi artikel wajib diisi.',
                'content.min'          => 'Isi artikel minimal 100 kata.',
                'status.required'      => 'Status artikel wajib dipilih.',
                'image.image'          => 'File harus berupa gambar.',
                'image.mimes'          => 'Format gambar harus JPG atau PNG.',
                'image.max'            => 'Ukuran gambar maksimal 2MB.',
            ]
        );

        $data = [
            'title'       => $request->title,
            'category_id' => $request->category_id,
            'content'     => $request->content,
            'status'      => $request->status,
        ];

        // kalau upload gambar baru
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($data);

        return redirect()
            ->route('staff.articles.index')
            ->with('success', 'Artikel berhasil diperbarui');
    }

    // ===============================
    // HAPUS
    // ===============================
    public function destroy(Article $article)
    {
        abort_if($article->user_id !== Auth::id(), 403);

        $article->delete();
        return back()->with('success', 'Artikel berhasil dihapus');
    }
}
