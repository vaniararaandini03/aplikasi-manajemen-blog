@extends('layouts.admin')

@section('content')
<h2>Manajemen Artikel</h2>

<table>
    <thead>
        <tr>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
        <tr>
            <td>{{ $article->title }}</td>
            <td>{{ $article->category->name ?? '-' }}</td>
            <td>
                {{ $article->is_published ? 'Published' : 'Draft' }}
            </td>
            <td>
                <a href="{{ route('admin.articles.edit', $article->id) }}">Edit</a>
                |
                <form action="{{ route('admin.articles.destroy', $article->id) }}"
                      method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus artikel?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
