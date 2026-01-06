@extends('layouts.admin')

@section('content')
<h2 class="mb-3">Tambah Artikel</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.articles.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Judul Artikel</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            {{-- 🔽 INPUT NAMA PENULIS --}}
            <div class="mb-3">
                <label>Nama Penulis</label>
                <input type="text" name="author" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Kategori</label>
                <select name="category_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Isi Artikel</label>
                <textarea name="content" class="form-control" rows="6" required></textarea>
            </div>

            <button class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection