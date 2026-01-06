@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.medium')

@section('title', 'Dashboard Admin')

@section('content')
<div class="row">

    <!-- FEED KIRI -->
    <div class="col-md-8">
        @foreach ($latest as $article)
        <article class="d-flex mb-4 border-bottom pb-3">
            <div class="me-3">
                <h4 class="fw-bold">{{ $article->title }}</h4>

                <small class="text-muted">
                    {{ $article->user->name ?? 'Admin' }} ·
                    {{ $article->created_at->diffForHumans() }}
                </small>

                <p>{{ Str::limit($article->content, 120) }}</p>
            </div>

            <img src="https://picsum.photos/160/110?random={{ $loop->index }}"
                 class="rounded">
        </article>
        @endforeach
    </div>

    <!-- SIDEBAR KANAN -->
    <aside class="col-md-4">
        <h5 class="fw-bold mb-3">Staff Picks</h5>

        @foreach ($editorChoice as $pick)
            <div class="mb-3">
                <strong>{{ Str::limit($pick->title, 50) }}</strong>
                <small class="text-muted d-block">
                    {{ $pick->created_at->diffForHumans() }}
                </small>
            </div>
        @endforeach
    </aside>

</div>
@endsection
