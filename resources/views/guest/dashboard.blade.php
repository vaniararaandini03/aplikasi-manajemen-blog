@extends('layouts.guest')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Guest Dashboard</h1>

    <!-- Search Form -->
    <form method="GET" action="{{ route('guest.search') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Cari artikel..." value="{{ request('q') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>

    <!-- Categories -->
    <div class="mb-4">
        <h3>Kategori</h3>
        <div class="d-flex flex-wrap gap-2">
            @foreach($categories as $category)
                <a href="{{ route('guest.category.articles', $category) }}" class="btn btn-outline-secondary">
                    {{ $category->name }} ({{ $category->articles_count }})
                </a>
            @endforeach
        </div>
    </div>

    <!-- Articles -->
    <div class="row">
        @forelse($articles as $article)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" alt="{{ $article->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ Str::limit($article->content, 100) }}</p>
                        <p class="text-muted">Oleh: {{ $article->author->name ?? 'Unknown' }}</p>
                        <a href="{{ route('guest.article.show', $article) }}" class="btn btn-primary">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">Tidak ada artikel ditemukan.</p>
            </div>
        @endforelse
    </div>

<!-- Pagination -->
    {{ $articles->links() }}
</div>
@endsection
