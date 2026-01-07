<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function home()
    {
        $articles = Article::where('status', 'published')
            ->with(['category', 'author'])
            ->latest()
            ->paginate(12);

        $categories = Category::withCount([
            'articles' => fn ($q) => $q->where('status', 'published')
        ])->get();

        return view('guest.home', compact('articles', 'categories'));
    }

    // 🔥 ARTIKEL WAJIB LOGIN
    public function showArticle(Article $article)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        abort_if($article->status !== 'published', 404);

        return view('guest.article-show', compact('article'));
    }

    // 🔥 KATEGORI WAJIB LOGIN
    public function articlesByCategory(Category $category)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $articles = $category->articles()
            ->where('status', 'published')
            ->with(['author'])
            ->latest()
            ->paginate(12);

        $categories = Category::withCount([
            'articles' => fn ($q) => $q->where('status', 'published')
        ])->get();

        return view('guest.category', compact(
            'category',
            'articles',
            'categories'
        ));
    }

    public function search(Request $request)
    {
        $query = $request->q;

        $articles = Article::where('status', 'published')
            ->where(fn ($q) =>
                $q->where('title', 'like', "%$query%")
                  ->orWhere('content', 'like', "%$query%")
            )
            ->with(['category', 'author'])
            ->latest()
            ->paginate(12);

        $categories = Category::withCount([
            'articles' => fn ($q) => $q->where('status', 'published')
        ])->get();

        return view('guest.home', compact('articles', 'categories', 'query'));
    }
}
