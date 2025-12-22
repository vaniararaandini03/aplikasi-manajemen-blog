@extends('layouts.medium')

@section('title', $article->title)

@section('content')
<article>
    <h1>{{ $article->title }}</h1>
    <div class="meta" style="margin-bottom:20px;">
        {{ $article->created_at->format('d M Y') }} | Status: {{ $article->status }}
    </div>

    <div>
        {!! $article->content !!}
    </div>

    <a href="{{ route(request()->route()->getPrefix() . '.articles.index') }}" class="btn" style="margin-top: 20px;">Kembali</a>
</article>
@endsection
