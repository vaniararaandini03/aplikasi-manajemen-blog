<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

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

    public function showArticle(Article $article)
    {
        abort_if($article->status !== 'published', 404);
        return view('guest.article-show', compact('article'));
    }

    public function articlesByCategory(Category $category)
    {
        $articles = $category->articles()
            ->where('status', 'published')
            ->latest()
            ->paginate(12);

        return view('guest.category', compact('category', 'articles'));
    }

    public function search(Request $request)
    {
        $query = $request->q;

        $articles = Article::where('status', 'published')
            ->where('title', 'like', "%$query%")
            ->paginate(12);

        $categories = Category::withCount('articles')->get();

        return view('guest.home', compact('articles', 'categories', 'query'));
    }

    public function dashboard()
    {
        $articles = Article::where('status', 'published')
            ->with(['category', 'author'])
            ->latest()
            ->paginate(12);

        $categories = Category::withCount([
            'articles' => fn ($q) => $q->where('status', 'published')
        ])->get();

        return view('guest.dashboard', compact('articles', 'categories'));
    }
}
