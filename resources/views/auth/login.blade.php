@extends('layouts.auth')
@section('title', env('APP_NAME') . ' - Login')
@section('content')
<form method="POST" action="{{ route('auth.login.authenticate') }}" >
    @csrf

    <h2 class="h3 mb-3 fw-normal">Login</h2>

    <div class="input-group mb-3">
        <label for="email" class="input-group-text"><i class="far fa-envelope"></i></label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Type your email" required>
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="input-group mb-3">
        <label for="password" class="input-group-text">
            <i class="fas fa-key" ></i>
        </label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Type your password" required>
        @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-sign-in-alt"></i> Sign in
        </button>
    </div>
</form>
<div class="text-center h6 mt-5 pt-3 border-top">
    <div class="row" >
        <div class="col text-center" >
            <a class="text-secondary me-3" href="{{ route('auth.register') }}" >
                <i class="fas fa-user-plus"></i> Register
            </a>
        </div>
        <div class="col text-center" >
            <a class="text-secondary me-3" href="{{ route('auth.password.forget') }}" >
                <i class="fas fa-key"></i> Forgot Password
            </a>
        </div>
    </div>
</div>
@endsection
