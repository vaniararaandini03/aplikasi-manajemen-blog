@extends('layouts.admin')

@section('content')
<h4>Edit Article</h4>

<form method="POST"
      action="{{ route('staff.articles.update', $article) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <input type="text" name="title"
               value="{{ $article->title }}"
               class="form-control">
    </div>

    <div class="mb-3">
        <textarea name="content" rows="8"
                  class="form-control">{{ $article->content }}</textarea>
    </div>

    <button class="btn btn-dark">Update</button>
</form>
@endsection
