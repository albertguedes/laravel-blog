@extends('layouts.auth')
@section('title', env('APP_NAME') . ' - Register')
@section('content')
<form method="POST" action="{{ route('auth.register.store') }}" >

    @csrf

    <h2 class="h3 mb-3 fw-normal">Register</h2>

    <div class="input-group mb-3">
        <label for="email" class="input-group-text">
            <i class="far fa-envelope" ></i>
        </label>
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

    <div class="input-group mb-3">
        <label for="password_confirmation" class="input-group-text">
            <i class="fas fa-key" ></i>
        </label>
        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm your password" required>
        @error('password_confirmation')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="input-group mb-3">
        <label for="name" class="input-group-text"><i class="fas fa-id-card px-0"></i></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Type your name" required>
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="input-group mb-3">
        <label for="username" class="input-group-text"><i class="fas fa-id-badge"></i></label>
        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" placeholder="Type a cool username" required>
        @error('username')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="input-group mb-3">
        <label for="about" class="input-group-text"><i class="fas fa-info"></i></label>
        <textarea name="about" class="form-control @error('about') is-invalid @enderror" placeholder="Type something about you" rows="4">{{ old('about') }}</textarea>
        @error('about')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Register
        </button>
    </div>

</form>
<div class="text-center h6 mt-5 pt-3 border-top">
    <div class="row" >
        <div class="col text-center" >
            <a class="text-secondary me-3" href="{{ route('auth.login') }}" >
                <i class="fas fa-sign-in-alt"></i> Login
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
