@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh">
    <div class="card p-4 shadow" style="width:400px">
        <h4 class="text-center mb-3">Login</h4>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>
            <input type="password" name="password" placeholder="Password" class="form-control mb-2" required>
            <button class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>
@endsection
