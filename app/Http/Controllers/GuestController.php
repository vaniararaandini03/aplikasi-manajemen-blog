<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class GuestController extends Controller
{
    // HOME (BOLEH DIAKSES TANPA LOGIN)
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

    // BACA ARTIKEL (WAJIB LOGIN - DIATUR DI ROUTE)
    public function showArticle(Article $article)
    {
        abort_if($article->status !== 'published', 404);

        $article->load(['category', 'author']);

        return view('guest.article-show', compact('article'));
    }

    // ARTIKEL PER KATEGORI (WAJIB LOGIN - DIATUR DI ROUTE)
    public function articlesByCategory(Category $category)
    {
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

    // SEARCH (BOLEH TANPA LOGIN)
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
