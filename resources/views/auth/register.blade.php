@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-2xl mb-4 font-bold">Register Akun</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label>Nama Lengkap</label>
            <input type="text" name="name" placeholder="Masukkan nama" required
                   class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" placeholder="Masukkan email" required
                   class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label>Password</label>
            <input type="password" name="password" placeholder="Password" required
                   class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" placeholder="Ulangi password" required
                   class="w-full border rounded px-3 py-2">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded font-semibold hover:bg-blue-700">
            Daftar
        </button>
    </form>

    <div class="text-center mt-4">
        Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 underline">Login</a>
    </div>
</div>
@endsection
