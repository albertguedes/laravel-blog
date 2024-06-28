@extends('layouts.auth')
@section('title', 'Login')
@section('content')
<div class="col-12">
    @include('partials.flash-message')
</div>
<form class="col-12 d-flex justify-content-center" action="{{ route('authenticate') }}" method="POST" >
    @csrf
    <div class="row">
        <div class="col-12 mb-3 input-group">
            <span class="input-group-text" id="user-addon"><i class="far fa-user"></i></span>
            <input type="text" name="credentials[username]" class="form-control @error('credentials.username') is-invalid @enderror" id="credential-username" aria-label="Username" aria-describedby="user-addon" placeholder="Type your username" value="">
            @error('credentials.username')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12 mb-3 input-group">
            <span class="input-group-text" id="key-addon"><i class="fas fa-key"></i></span>
            <input type="password" name="credentials[password]" class="form-control @error('credentials.password') is-invalid @enderror" id="credential-password" aria-label="Username" aria-describedby="key-addon" placeholder="Type your password" value="" >
            @error('credentials.password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12 d-flex justify-content-center">
            <button class="btn btn-dark" ><i class="fas fa-sign-in-alt"></i> Login</button>
        </div>
    </div>
</form>
@endsection
