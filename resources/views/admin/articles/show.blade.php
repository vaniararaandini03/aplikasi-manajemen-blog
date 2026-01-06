@extends('layouts.admin')

@section('title', $article->title)

@section('content')

<div style="
    max-width:800px;
    margin:0 auto;
    font-family: Georgia, serif;
">

    <!-- Title -->
    <h1 style="
        font-size:42px;
        line-height:1.2;
        margin-bottom:12px;
        color:#242424;
    ">
        {{ $article->title }}
    </h1>

    <!-- Meta -->
    <div style="
        font-size:14px;
        color:#777;
        margin-bottom:30px;
    ">
        {{ $article->created_at->format('d M Y') }}
        &nbsp;•&nbsp;
        Status:
        @if($article->status === 'published')
            <span style="color:#1a8917;font-weight:bold;">Published</span>
        @else
            <span style="color:#999;">Draft</span>
        @endif
    </div>

    <!-- Content -->
    <article style="
        font-size:20px;
        line-height:1.8;
        color:#333;
        margin-bottom:50px;
    ">
        {!! $article->content !!}
    </article>

    <!-- Back -->
    <a href="{{ route('admin.articles.index') }}"
       style="
        display:inline-block;
        text-decoration:none;
        color:#1a8917;
        font-weight:bold;
        font-size:15px;
       ">
        ← Kembali ke daftar artikel
    </a>

</div>

@endsection
