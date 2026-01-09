@extends('layouts.admin')

@section('content')
<div class="container">

    <a href="{{ route('admin.articles.index') }}"
       class="btn btn-secondary mb-3">
        ← Kembali
    </a>

    <div class="card shadow-sm">
        <div class="card-body">

            <h3 class="mb-2">{{ $article->title }}</h3>

            <p class="text-muted mb-3">
                Kategori : <strong>{{ $article->category->name ?? '-' }}</strong> |
                Penulis : <strong>{{ $article->author }}</strong> |
                Status : 
                <span class="badge bg-success">
                    {{ ucfirst($article->status) }}
                </span>
            </p>

            @if($article->image)
                <img src="{{ asset('storage/'.$article->image) }}"
                     class="img-fluid rounded mb-3"
                     style="max-height:300px;">
            @endif

            <hr>

            <div class="mt-3">
                {!! nl2br(e($article->content)) !!}
            </div>

        </div>
    </
