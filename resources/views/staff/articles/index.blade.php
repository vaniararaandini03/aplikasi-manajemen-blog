@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>My Articles</h4>
    <a href="{{ route('staff.articles.create') }}" class="btn btn-dark">
        + Write Article
    </a>
</div>

@foreach($articles as $article)
<div class="card mb-3">
    <div class="card-body">
        <h5>{{ $article->title }}</h5>

        <p class="text-muted">
            {{ Str::limit(strip_tags($article->content), 120) }}
        </p>

        <span class="badge bg-warning">
            {{ ucfirst($article->status) }}
        </span>

        <div class="mt-3">
            <a href="{{ route('staff.articles.edit', $article) }}"
               class="btn btn-sm btn-primary">Edit</a>

            <form method="POST"
                  action="{{ route('staff.articles.destroy', $article) }}"
                  class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger"
                        onclick="return confirm('Hapus artikel?')">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endforeach

{{ $articles->links() }}
@endsection
