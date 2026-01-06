@extends('layouts.admin')

@section('content')
<h2 class="mb-3">Edit Artikel</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.articles.update', $article->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Judul Artikel</label>
                <input type="text" name="title"
                       class="form-control"
                       value="{{ $article->title }}" required>
            </div>

            <div class="mb-3">
                <label>Kategori</label>
                <select name="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $article->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Isi Artikel</label>
                <textarea name="content" class="form-control" rows="6" required>{{ $article->content }}</textarea>
            </div>

            <button class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
