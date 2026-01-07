@extends('layouts.admin')

@section('title', 'Manajemen Kategori')

@section('content')
<div class="container-fluid px-4 py-4"><!-- ✅ atas & bawah sama -->

    <!-- Header -->
    <div class="mb-4">
        <h2 class="fw-bold mb-1">Manajemen Kategori</h2>
        <p class="text-muted mb-0">Daftar seluruh kategori artikel</p>
    </div>

    <!-- Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4"><!-- ✅ padding konsisten -->

            @if($categories->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th style="width:70px;" class="text-center">No</th>
                                <th>Nama Kategori</th>
                                <th style="width:120px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $index => $category)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>
                                        <a href="{{ route('admin.categories.show', $category->id) }}"
                                           class="fw-semibold text-decoration-none text-dark">
                                            {{ $category->name }}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.categories.show', $category->id) }}"
                                           class="btn btn-sm btn-outline-success rounded-pill px-3">
                                            Lihat
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <p class="text-muted mb-0">Belum ada kategori.</p>
                </div>
            @endif

        </div>
    </div>

</div>
@endsection
