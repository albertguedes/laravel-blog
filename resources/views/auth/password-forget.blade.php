@extends('layouts.auth')
@section('title', 'Forgot Password')
@section('content')
<form method="POST" action="{{ route('auth.password.forget.update') }}">
    @csrf

    <h2 class="h3 mb-3 fw-normal">Forgot Password</h2>

    <input type="hidden" name="token" value="{{ isset($token) ? $token : '' }}" >

    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="" placeholder="Type your registred email" required>
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="fas fa-envelope" ></i> Send
        </button>
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

</form>
<div class="text-center h6 mt-5 pt-3 border-top">
    <div class="row" >
        <div class="col text-center" >
            <a class="text-secondary" href="{{ route('auth.login') }}" >
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
        </div>
        <div class="col text-center" >
            <a class="text-secondary" href="{{ route('auth.register') }}" >
                <i class="fas fa-user-plus"></i> Register
            </a>
        </div>
    </div>
</div>
@endsection
