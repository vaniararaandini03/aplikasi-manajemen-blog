@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">

    <h1 class="mt-4 fw-bold">Admin Dashboard</h1>
    <p class="text-muted">Kelola seluruh konten dan aktivitas aplikasi</p>

    <!-- STATISTIC -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Total Articles</small>
                    <h3 class="fw-bold">{{ $totalArticles }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Published</small>
                    <h3 class="fw-bold text-success">{{ $publishedArticles }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Draft</small>
                    <h3 class="fw-bold text-warning">{{ $draftArticles }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Users</small>
                    <h3 class="fw-bold">{{ $totalUsers }}</h3>
                </div>
            </div>
        </div>
    </div>

        <!-- ARTICLE LIST -->
    <div class="card border-0 shadow-sm mt-5">
        <div class="card-header bg-white fw-bold">
            List Artikel
        </div>

        <div class="card-body">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Judul</th>
                        <th>Author</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td class="fw-semibold">{{ $article->title }}</td>

                        <td>{{ $article->user->name ?? 'Admin' }}</td>

                        <td>
                            <span class="badge bg-secondary">
                                {{ $article->category->name ?? '-' }}
                            </span>
                        </td>

                        <td>
                            @if($article->status == 'published')
                                <span class="badge bg-success">Published</span>
                            @elseif($article->status == 'draft')
                                <span class="badge bg-warning text-dark">Draft</span>
                            @else
                                <span class="badge bg-secondary">Pending</span>
                            @endif
                        </td>

                        <td class="text-muted">
                            {{ $article->created_at->format('d M Y') }}
                        </td>

                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                            <a href="#" class="btn btn-sm btn-outline-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection
