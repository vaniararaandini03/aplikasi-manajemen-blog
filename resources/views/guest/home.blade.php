@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <form method="GET" action="{{ route('guest.search') }}" class="d-flex">
            <input type="text" name="q" class="form-control me-2" placeholder="Cari artikel..." value="{{ $query ?? '' }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>
    </div>
</div>

@if(isset($query))
<div class="row mb-3">
    <div class="col-12">
        <p class="text-muted">Hasil pencarian untuk: <strong>"{{ $query }}"</strong></p>
    </div>
</div>
@endif

<div class="row">

    {{-- Main content --}}
    <div class="col-md-8">
        @foreach($articles as $article)
            <div class="card-article mb-4 p-3 border rounded">
                <h3>
                    <a href="{{ route('guest.article.show', $article->id) }}">{{ $article->title }}</a>
                </h3>
                <p class="text-muted">
                    By {{ $article->author->name ?? 'Unknown' }} | {{ $article->created_at->format('M d, Y') }}
                </p>
                <p>{{ Str::limit($article->content, 200, '...') }}</p>
            </div>
        @endforeach

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="col-md-4">
        <div class="card p-3 mb-4">
            <h5>Categories</h5>
            <ul class="list-unstyled">
                @foreach($categories as $category)
                    <li class="mb-2">
                        <a href="{{ route('guest.category.articles', $category->id) }}">
                            {{ $category->name }} ({{ $category->articles_count }})
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

</div>
@endsection
