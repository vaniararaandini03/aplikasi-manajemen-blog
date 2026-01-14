@extends('layouts.staff-profile')

@section('title', 'Profil Saya')

@section('content')
<div class="container-fluid py-4">

    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">👤 Profil Saya</h2>
                    <p class="text-muted mb-0">Kelola informasi pribadi dan pengaturan akun Anda</p>
                </div>
                <div class="text-end">
                    <small class="text-muted">Terakhir login: {{ auth()->user()->updated_at->diffForHumans() }}</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">📝 Informasi Pribadi</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('staff.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Profile Photo Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="form-label fw-bold">Foto Profil</label>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="position-relative">
                                        @if(auth()->user()->profile_image)
                                            <img src="{{ asset('storage/' . auth()->user()->profile_image) }}"
                                                 alt="Profile Photo"
                                                 class="rounded-circle border"
                                                 style="width: 100px; height: 100px; object-fit: cover;">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=1a73e8&color=fff&size=100"
                                                 alt="Default Avatar"
                                                 class="rounded-circle border">
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <input type="file" name="profile_image" class="form-control mb-2" accept="image/*">
                                        <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                                        @if(auth()->user()->profile_image)
                                            <div class="mt-2">
                                                <button type="submit" name="remove_photo" value="1"
                                                        class="btn btn-outline-danger btn-sm"
                                                        onclick="return confirm('Yakin ingin menghapus foto profil?')">
                                                    🗑️ Hapus Foto
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Name Field -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Password Change Section -->
                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label fw-bold">Ubah Password (Opsional)</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                               name="current_password" placeholder="Password saat ini">
                                        @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                               name="password" placeholder="Password baru">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                               name="password_confirmation" placeholder="Konfirmasi password">
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    💾 Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Statistics Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h6 class="mb-0">📊 Statistik Aktivitas</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <div class="number text-primary">{{ auth()->user()->articles->count() }}</div>
                            <small class="text-muted">Artikel</small>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="number text-success">{{ auth()->user()->articles->where('status', 'published')->count() }}</div>
                            <small class="text-muted">Dipublikasikan</small>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="number text-warning">{{ auth()->user()->articles->where('status', 'draft')->count() }}</div>
                            <small class="text-muted">Draft</small>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="number text-info">{{ auth()->user()->articles->where('is_editor_choice', true)->count() }}</div>
                            <small class="text-muted">Editor Choice</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h6 class="mb-0">⚡ Aksi Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('staff.articles.create') }}" class="btn btn-outline-primary btn-sm">
                            ✍️ Tulis Artikel Baru
                        </a>
                        <a href="{{ route('staff.articles.index') }}" class="btn btn-outline-secondary btn-sm">
                            📝 Kelola Artikel
                        </a>
                        <a href="{{ route('staff.dashboard') }}" class="btn btn-outline-info btn-sm">
                            🏠 Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>

            <!-- Account Info -->
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h6 class="mb-0">ℹ️ Info Akun</h6>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <strong>Role:</strong> <span class="badge bg-primary">{{ ucfirst(auth()->user()->role) }}</span>
                    </div>
                    <div class="mb-2">
                        <strong>Bergabung:</strong> <br>
                        <small class="text-muted">{{ auth()->user()->created_at->format('d M Y') }}</small>
                    </div>
                    <div class="mb-2">
                        <strong>Terakhir Update:</strong> <br>
                        <small class="text-muted">{{ auth()->user()->updated_at->format('d M Y H:i') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);
});
</script>
@endsection
