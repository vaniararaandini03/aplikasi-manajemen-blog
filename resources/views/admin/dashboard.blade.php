@php use Illuminate\Support\Str; @endphp

@extends('layouts.admin')

@section('content')

<h1 class="mb-4">Dashboard</h1>

<div class="row">

    {{-- KIRI: FEED ARTIKEL --}}
    <div class="col-md-8">

        <h4 class="mb-3">For You</h4>

        @forelse($recentArticles as $article)
            <div class="mb-4 border-bottom pb-3">
                <h5 class="fw-bold">{{ $article->title }}</h5>

                <p class="text-muted mb-1">
                    {{ Str::limit($article->content, 120) }}
                </p>

                <small class="text-muted">
                    {{ $article->created_at->format('d M Y') }}
                </small>
            </div>
        @empty
            <p>No articles</p>
        @endforelse

    </div>

    {{-- KANAN: SIDEBAR --}}
    <div class="col-md-4">

        <h5 class="mb-3">Editor’s Choice</h5>

        <ul class="list-group">
            @foreach($recentArticles->take(3) as $article)
                <li class="list-group-item border-0 px-0">
                    <strong>{{ $article->title }}</strong>
                </li>
            @endforeach
        </ul>

    </div>

</div>

@endsection
