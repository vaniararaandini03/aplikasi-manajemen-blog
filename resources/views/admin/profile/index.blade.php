@extends('layouts.admin')

@section('title', 'Profil Saya')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-user"></i> Profil Saya</h4>
                </div>
                <div class="card-body">

                    {{-- Success/Error Messages --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle"></i>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Profile Photo Section --}}
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                @if(auth()->user()->profile_image)
                                    <img src="{{ asset('storage/' . auth()->user()->profile_image) }}"
                                         alt="Profile Photo"
                                         class="rounded-circle border"
                                         style="width: 120px; height: 120px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center"
                                         style="width: 120px; height: 120px; font-size: 3rem;">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                @endif

                                {{-- Photo Upload --}}
                                <div class="mt-3">
                                    <label for="profile_image" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-camera"></i> Ubah Foto
                                    </label>
                                    <input type="file" id="profile_image" name="profile_image"
                                           class="d-none" accept="image/*" onchange="previewImage(this)">
                                </div>

                                {{-- Remove Photo --}}
                                @if(auth()->user()->profile_image)
                                    <div class="mt-2">
                                        <button type="submit" name="remove_photo" value="1"
                                                class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus foto profil?')">
                                            <i class="fas fa-trash"></i> Hapus Foto
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Personal Information --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Account Information (Read-only) --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Role</label>
                                <input type="text" class="form-control" value="{{ ucfirst(auth()->user()->role) }}" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Bergabung Sejak</label>
                                <input type="text" class="form-control"
                                       value="{{ auth()->user()->created_at->format('d M Y') }}" readonly>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // You can add image preview functionality here if needed
            alert('Foto akan diupload setelah Anda menyimpan perubahan.');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<style>
.card {
    border: none;
    border-radius: 10px;
}

.card-header {
    border-radius: 10px 10px 0 0 !important;
}

.btn {
    border-radius: 6px;
}

.form-control {
    border-radius: 6px;
}

.alert {
    border-radius: 8px;
}
</style>
@endsection
