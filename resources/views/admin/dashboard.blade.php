@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h2 class="mb-4">Dashboard Admin</h2>

    {{-- Tombol Buat Staff Baru --}}
    <div class="mb-4">
        <a href="{{ route('admin.staff.create') }}" class="btn btn-primary">
            + Buat Staff Baru
        </a>
    </div>

    {{-- Statistik --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center bg-light p-3">
                <h5>Total Artikel</h5>
                <h3>{{ $totalArticles }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-success text-white p-3">
                <h5>Published</h5>
                <h3>{{ $publishedArticles }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-warning text-dark p-3">
                <h5>Draft</h5>
                <h3>{{ $draftArticles }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-info text-white p-3">
                <h5>Total Users</h5>
                <h3>{{ $totalUsers }}</h3>
            </div>
        </div>
    </div>

    {{-- List Artikel Terbaru --}}
    <h4 class="mb-3">Artikel Terbaru</h4>
    <div class="row">
        @forelse($articles as $article)
            <div class="col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text text-truncate">{{ $article->content }}</p>
                        <p class="mb-1"><small>Status:
                            <span class="badge bg-{{ $article->status == 'published' ? 'success' : 'secondary' }}">
                                {{ ucfirst($article->status) }}
                            </span>
                        </small></p>
                        <a href="{{ route('admin.articles.show', $article->id) }}" class="btn btn-sm btn-primary">Lihat</a>
                        <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus artikel ini?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada artikel.</p>
        @endforelse
    </div>
</div>
@endsection
