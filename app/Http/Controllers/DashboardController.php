{
        return view('admin.dashboard');
    }
=======
    public function index()
    {
        $totalArticles = \App\Models\Article::count();
        $totalUsers = \App\Models\User::count();
        $totalCategories = \App\Models\Category::count();
        $recentArticles = \App\Models\Article::with('user', 'category')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalArticles', 'totalUsers', 'totalCategories', 'recentArticles'));
    }
