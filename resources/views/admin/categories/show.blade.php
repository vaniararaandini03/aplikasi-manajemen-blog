@extends('layouts.admin')

@section('content')
<h2 class="mb-3">
    Artikel Kategori: <span class="text-primary">{{ $category->name }}</span>
</h2>

<div class="card">
    <div class="card-body">
        @if ($articles->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Artikel</th>
                        <th>Penulis</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $index => $article)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->user->name ?? '-' }}</td>
                            <td>{{ $article->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-muted">
                Belum ada artikel pada kategori <strong>{{ $category->name }}</strong>.
            </p>
        @endif
    </div>
</div>

<a href="{{ route('admin.categories.index') }}" class="btn btn-secondary mt-3">
    ← Kembali ke Kategori
</a>
@endsection
