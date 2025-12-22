@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- Category Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">Kategori: {{ $category->name }}</h2>
                    <p class="text-muted mb-0">
                        {{ $articles->total() }} artikel dalam kategori ini
                    </p>
                </div>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    {{-- Articles Grid --}}
    <div class="row">
        @forelse($articles as $article)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($article->thumbnail)
                        <img src="{{ asset('storage/' . $article->thumbnail) }}"
                             class="card-img-top" alt="{{ $article->title }}"
                             style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                             style="height: 200px;">
                            <span class="text-muted">Tidak ada gambar</span>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text text-truncate">
                            {{ Str::limit(strip_tags($article->content), 100) }}
                        </p>

                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <small class="text-muted">
                                    {{ $article->created_at->format('d M Y') }}
                                </small>
                                <span class="badge bg-primary">
                                    {{ $category->name }}
                                </span>
                            </div>

                            <a href="{{ route('guest.article.show', $article->id) }}"
                               class="btn btn-primary btn-sm w-100">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-folder-open fa-3x text-muted"></i>
                    </div>
                    <h4 class="text-muted">Belum ada artikel dalam kategori ini</h4>
                    <p class="text-muted">
                        Kategori ini masih kosong. Silakan kembali nanti.
                    </p>
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($articles->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    {{ $articles->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    @endif

</div>
@endsection
