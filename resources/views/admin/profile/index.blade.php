@extends('layouts.admin')

@section('title', 'Profil Saya')

@section('content')
<style>
.profile-title {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 1.4rem;
    font-weight: 600;
}

.profile-subtitle {
    color: #6b7280;
    font-size: .9rem;
    margin-bottom: 24px;
}

.profile-layout {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 24px;
}

/* CARD */
.card-box {
    background: #fff;
    border-radius: 14px;
    padding: 22px;
    box-shadow: 0 10px 28px rgba(0,0,0,.06);
}

.card-header {
    font-weight: 600;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* FOTO */
.profile-photo {
    display: flex;
    gap: 16px;
    align-items: center;
    margin-bottom: 20px;
}

.avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: #ede9fe;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: 600;
    color: #6d28d9;
    overflow: hidden;
}

.avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.file-info {
    font-size: .8rem;
    color: #6b7280;
}

/* FORM */
.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-size: .8rem;
    margin-bottom: 4px;
}

.form-group input {
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    font-size: .9rem;
}

.form-group input:focus {
    outline: none;
    border-color: #7c3aed;
}

/* BUTTON */
.btn-primary {
    background: #7c3aed;
    color: #fff;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    cursor: pointer;
}

.btn-outline {
    border: 1px solid #7c3aed;
    background: transparent;
    color: #7c3aed;
    padding: 8px 14px;
    border-radius: 8px;
    font-size: .85rem;
}

/* STAT */
.stat-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    text-align: center;
}

.stat-number {
    font-size: 1.6rem;
    font-weight: 700;
}

.stat-label {
    font-size: .8rem;
    color: #6b7280;
}
</style>

{{-- TITLE --}}
<div class="profile-title">
    👤 Profil Saya
</div>
<div class="profile-subtitle">
    Kelola informasi akun administrator
</div>

<div class="profile-layout">

    {{-- LEFT --}}
    <div class="card-box">
        <div class="card-header">📋 Informasi Pribadi</div>

        <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- PHOTO --}}
            <div class="profile-photo">
                <div class="avatar">
                    @if(auth()->user()->profile_image)
                        <img src="{{ asset('storage/'.auth()->user()->profile_image) }}">
                    @else
                        {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                    @endif
                </div>

                <div>
                    <input type="file" name="profile_image">
                    <div class="file-info">JPG, PNG • Maks 2MB</div>
                </div>
            </div>

            {{-- FORM --}}
            <div class="form-grid">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" value="{{ auth()->user()->name }}">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ auth()->user()->email }}">
                </div>
            </div>

            {{-- PASSWORD --}}
            <div class="form-grid" style="margin-top:14px">
                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" name="password">
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation">
                </div>
            </div>

            {{-- ACTION --}}
            <div style="margin-top:24px; display:flex; justify-content:flex-end;">
                <button class="btn-primary">💾 Simpan Perubahan</button>
            </div>
        </form>
    </div>

    {{-- RIGHT --}}
    <div class="card-box">
        <div class="card-header">📊 Informasi Akun</div>

        <div class="stat-grid">
            <div>
                <div class="stat-number" style="color:#7c3aed">
                    {{ auth()->user()->articles()->count() ?? 0 }}
                </div>
                <div class="stat-label">Artikel</div>
            </div>

            <div>
                <div class="stat-number" style="color:#16a34a">
                    {{ auth()->user()->created_at->diffForHumans() }}
                </div>
                <div class="stat-label">Bergabung</div>
            </div>
        </div>

        <div style="margin-top:24px; text-align:center">
            <a href="{{ route('admin.dashboard') }}" class="btn-outline">
                ← Kembali Dashboard
            </a>
        </div>
    </div>

</div>
@endsection
