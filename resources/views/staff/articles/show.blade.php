@extends('layouts.staff')

@section('title', 'Detail Artikel')

@section('content')

<div style="max-width:800px;margin:0 auto;font-family:Georgia,serif;">

    <a href="{{ route('staff.articles.index') }}"
       style="background:#6c757d;color:#fff;padding:8px 16px;text-decoration:none;border-radius:4px;display:inline-block;margin-bottom:20px;">
        ← Kembali ke Artikel Saya
    </a>

    <div class="card shadow-sm">
        <div class="card-body">

            {{-- JUDUL --}}
            <h3 class="mb-2 fw-bold">{{ $article->title }}</h3>

            {{-- META ARTIKEL --}}
            <p class="text-muted mb-3" style="font-size:14px;">
                <strong>Kategori:</strong>
                {{ $article->category->name ?? '-' }}
                &nbsp;|&nbsp;

                <strong>Penulis:</strong>
                {{ $article->user->name ?? '-' }}
                &nbsp;|&nbsp;

                <strong>Status:</strong>
                <span class="badge bg-success">
                    {{ ucfirst($article->status) }}
                </span>
            </p>

            {{-- GAMBAR --}}
            @if($article->image)
                <div class="text-center">
                    <img src="{{ asset('storage/'.$article->image) }}"
                         class="img-fluid rounded mb-3"
                         style="max-height:320px;">
                </div>
            @endif

            <hr>

            {{-- ISI ARTIKEL --}}
            <div class="mt-3" style="line-height:1.8;font-size:16px;color:#333;">
                {!! nl2br(e($article->content)) !!}
            </div>

        </div>
    </div>

</div>

@endsection
