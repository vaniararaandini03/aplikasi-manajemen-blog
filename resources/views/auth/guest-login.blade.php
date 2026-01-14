@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh">
    <div class="card p-4 shadow" style="width:400px">
        <h4 class="text-center mb-2">Login untuk Membaca Artikel</h4>
        <p class="text-center text-muted mb-3">
            Silakan login sebagai <strong>Guest</strong> untuk mengakses artikel dan kategori
        </p>

        {{-- NOTIFIKASI ERROR --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- NOTIFIKASI SUCCESS --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('guest.login.submit') }}">
            @csrf

            <input
                type="email"
                name="email"
                class="form-control mb-2"
                placeholder="Email"
                value="{{ old('email') }}"
                required
            >

            <input
                type="password"
                name="password"
                class="form-control mb-3"
                placeholder="Password"
                required
            >

            <button type="submit" class="btn btn-primary w-100">
                Login
            </button>
        </form>

        <div class="text-center mt-3">
            <small>
                Belum punya akun?
                <a href="{{ route('guest.register') }}">Daftar di sini</a>
            </small>
        </div>
    </div>
</div>
@endsection
