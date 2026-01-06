@extends('layouts.guest')

@section('title', $article->title)

@section('content')
<div class="container py-4">

    {{-- Tombol kembali --}}
    <a href="{{ url('/') }}" class="btn btn-sm btn-secondary mb-3">
        ← Kembali ke Beranda
    </a>

    {{-- Judul --}}
    <h1 class="mb-2">{{ $article->title }}</h1>

    {{-- Meta --}}
    <div class="text-muted mb-3">
        Oleh {{ optional($article->author)->name ?? 'Admin' }}
        |
        {{ $article->created_at->format('d M Y') }}
    </div>

    {{-- Kategori --}}
    @if ($article->category)
        <span class="badge bg-primary mb-3">
            {{ $article->category->name }}
        </span>
    @endif

    <hr>

    {{-- Konten --}}
    <div class="mt-4 fs-5" style="line-height: 1.8">
        {!! nl2br(e($article->content)) !!}
    </div>

</div>
@endsection
