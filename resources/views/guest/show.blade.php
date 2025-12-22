@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- Back Button --}}
    <div class="mb-3">
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
            ← Kembali ke Beranda
        </a>
    </div>

    {{-- Article Content --}}
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <article>
                {{-- Article Header --}}
                <header class="mb-4">
                    <h1 class="display-5 mb-3">{{ $article->title }}</h1>

                    @if($article->thumbnail)
                        <img src="{{ asset('storage/' . $article->thumbnail) }}"
                             class="img-fluid rounded mb-3" alt="{{ $article->title }}">
                    @endif

                    <div class="text-muted">
                        <small>
                            Dipublikasikan pada {{ $article->created_at->format('d F Y') }}
                            @if($article->updated_at != $article->created_at)
                                | Diperbarui pada {{ $article->updated_at->format('d F Y') }}
                            @endif
                        </small>
                    </div>
                </header>

                {{-- Article Body --}}
                <div class="article-content mb-5">
                    {!! nl2br(e($article->content)) !!}
                </div>

                {{-- Article Footer --}}
                <footer class="border-top pt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            <small>Kategori: {{ $article->category->name ?? 'Umum' }}</small>
                        </div>
                        <div>
                            <button class="btn btn-outline-primary btn-sm" onclick="window.print()">
                                🖨️ Cetak
                            </button>
                            <button class="btn btn-outline-secondary btn-sm" onclick="shareArticle()">
                                📤 Bagikan
                            </button>
                        </div>
                    </div>
                </footer>
            </article>
        </div>
    </div>

    {{-- Related Articles --}}
    @if($relatedArticles->count() > 0)
    <div class="row mt-5">
        <div class="col-12">
            <h4 class="mb-3">Artikel Terkait</h4>
            <div class="row">
                @foreach($relatedArticles as $related)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 shadow-sm">
                            @if($related->thumbnail)
                                <img src="{{ asset('storage/' . $related->thumbnail) }}"
                                     class="card-img-top" alt="{{ $related->title }}"
                                     style="height: 150px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h6 class="card-title">{{ $related->title }}</h6>
                                <a href="{{ route('guest.article.show', $related->id) }}"
                                   class="btn btn-sm btn-outline-primary">Baca</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

</div>

<script>
function shareArticle() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $article->title }}',
            url: window.location.href
        });
    } else {
        // Fallback untuk browser yang tidak mendukung Web Share API
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(() => {
            alert('Link artikel berhasil disalin ke clipboard!');
        });
    }
}
</script>
@endsection
