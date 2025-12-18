@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4">🔥 Latest Articles</h2>
    <div class="row">
        @foreach($latest as $item)
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <img src="{{ $item->thumbnail ?? 'https://via.placeholder.com/300x200' }}" class="card-img-top">
                <div class="card-body">
                    <span class="badge bg-primary">{{ $item->category->name ?? '-' }}</span>
                    <h5 class="mt-2">{{ $item->title }}</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <hr>

    <h2 class="mb-4">🏷️ Genre</h2>
    <div class="d-flex gap-2 flex-wrap">
        @foreach($categories as $cat)
            <a href="#" class="btn btn-outline-primary">{{ $cat->name }}</a>
        @endforeach
    </div>

    <hr>

    <h2 class="mb-4">🏆 Editor's Choice</h2>
    <div class="row">
        @foreach($editorChoice as $item)
        <div class="col-md-3 mb-3">
            <div class="card border-danger">
                <div class="card-body">
                    <h6>{{ $item->title }}</h6>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
