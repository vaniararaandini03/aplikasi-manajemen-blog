@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh">
    <div class="card p-4 shadow" style="width:400px">
        <h4 class="text-center mb-3">Login</h4>

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

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input
                type="email"
                name="email"
                placeholder="Email"
                value="{{ old('email') }}"
                class="form-control mb-2"
                required
            >

            <input
                type="password"
                name="password"
                placeholder="Password"
                class="form-control mb-3"
                required
            >

            <button class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>
@endsection
