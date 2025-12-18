@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.medium')

@section('content')
<div class="layout">

    <!-- FEED KIRI -->
    <div class="feed">
        @foreach ($latest as $article)
        <article class="article-item">
            <div class="article-text">
                <h2>{{ $article->title }}</h2>

                <small class="text-muted">
                    {{ $article->user->name ?? 'Admin' }} ·
                    {{ $article->created_at->diffForHumans() }}
                </small>

                <p>{{ Str::limit($article->content, 120) }}</p>
            </div>

            <img src="https://picsum.photos/200/120?random={{ $loop->index }}">
        </article>
        @endforeach
    </div>

    <!-- SIDEBAR KANAN -->
    <aside class="sidebar">
        <h4>Staff Picks</h4>

        @foreach ($editorChoice as $pick)
            <div class="staff-pick">
                <strong>{{ Str::limit($pick->title, 50) }}</strong>
                <small class="text-muted d-block">
                    {{ $pick->created_at->diffForHumans() }}
                </small>
            </div>
        @endforeach
    </aside>

</div>
@endsection
