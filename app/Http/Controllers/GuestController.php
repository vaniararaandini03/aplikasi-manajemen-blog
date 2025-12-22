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

        $categories = Category::withCount(['articles' => function($query) {
            $query->where('status', 'published');
        }])->get();

        return view('guest.home', compact('articles', 'categories'));
    }

    public function showArticle(Article $article)
    {
        if ($article->status !== 'published') {
            abort(404);
        }

        return view('guest.article-show', compact('article'));
    }

    public function articlesByCategory(Category $category)
    {
        $articles = $category->articles()
            ->where('status', 'published')
            ->latest()
            ->paginate(12);

        $categories = Category::withCount(['articles' => function($query) {
            $query->where('status', 'published');
        }])->get();

        return view('guest.home', compact('articles', 'categories'));
    }
}
