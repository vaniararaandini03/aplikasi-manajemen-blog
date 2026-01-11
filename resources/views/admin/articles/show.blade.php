@extends('layouts.admin')

@section('title', $article->title)

@section('content')

<div style="max-width:800px;margin:0 auto;font-family:Georgia, serif;">

    {{-- JUDUL --}}
    <h1 style="font-size:42px;line-height:1.2;margin-bottom:12px;color:#242424;">
        {{ $article->title }}
    </h1>

    {{-- META --}}
    <div style="font-size:14px;color:#777;margin-bottom:20px;">
        {{ $article->created_at->format('d M Y') }}
        &nbsp;•&nbsp;
        Status:
        @if($article->status === 'published')
            <span style="color:#1a8917;font-weight:bold;">Published</span>
        @else
            <span style="color:#999;">Draft</span>
        @endif
    </div>

    {{-- GAMBAR --}}
    @if ($article->image)
        <img src="{{ asset('storage/' . $article->image) }}"
             alt="{{ $article->title }}"
             style="width:100%;max-height:350px;object-fit:cover;border-radius:14px;margin-bottom:30px;">
    @endif

    {{-- KONTEN --}}
    <article style="font-size:20px;line-height:1.8;color:#333;margin-bottom:50px;">
        {!! nl2br(e($article->content)) !!}
    </article>

    {{-- BACK --}}
    <a href="{{ route('admin.articles.index') }}"
       style="text-decoration:none;color:#1a8917;font-weight:bold;">
        ← Kembali ke daftar artikel
    </a>

</div>

@endsection
