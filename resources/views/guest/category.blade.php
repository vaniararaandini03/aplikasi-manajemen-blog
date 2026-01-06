@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Kategori: {{ $category->name }}</h2>
            <p class="text-muted mb-0">
                {{ $articles->total() }} artikel
            </p>
        </div>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
            ← Kembali
        </a>
    </div>

    {{-- Artikel --}}
    <div class="row">
        @forelse ($articles as $article)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5>{{ $article->title }}</h5>
                        <p class="text-muted small mb-2">
                            {{ $article->created_at->format('d M Y') }}
                        </p>

                        <p class="flex-grow-1">
                            {{ Str::limit(strip_tags($article->content), 120) }}
                        </p>

                        <a href="{{ route('guest.article.show', $article->id) }}"
                           class="btn btn-primary btn-sm mt-auto">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h5 class="text-muted">
                    Belum ada artikel di kategori ini
                </h5>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $articles->links() }}
    </div>

</div>
@endsection
