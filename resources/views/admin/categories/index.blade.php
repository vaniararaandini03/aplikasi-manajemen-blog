@extends('layouts.admin')

@section('content')
<h2 class="mb-3">Manajemen Kategori</h2>

<div class="card">
    <div class="card-body">
        @if ($categories->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $index => $category)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <a href="{{ route('admin.categories.show', $category->id) }}"
                                   class="text-decoration-none">
                                    {{ $category->name }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-muted">Belum ada kategori.</p>
        @endif
    </div>
</div>
@endsection
