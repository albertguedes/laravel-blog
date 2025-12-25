@extends('layouts.auth')
@section('title', '')
@section('content')
<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <div class="input-group mb-3">
        <label for="password" class="input-group-text"><i class="fas fa-lock"></i></label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Type your current password" required autocomplete="current-password">
        @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="input-group mb-3">
        <label for="password_confirmation" class="input-group-text"><i class="fas fa-lock"></i></label>
        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Type your new password" required autocomplete="new-password">
        @error('password_confirmation')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 text-center" >
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-lock"></i> Update Password
        </button>
    </div>

</form>
@endsection
