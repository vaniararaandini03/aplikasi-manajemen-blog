@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height:100vh">
        <div class="card p-4 shadow" style="width:400px">
            <h4 class="text-center mb-3">Login Sistem</h4>

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-primary w-100">Login</button>
                <div class="text-center mt-3">
                    <a href="{{ route('register') }}" class="text-decoration-none">
                        Belum punya akun? <strong>Daftar</strong>
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
