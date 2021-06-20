@extends('layouts.auth')
@section('title', 'Login')
@section('content')
<div class="row pt-5" >
    <div class="col-12" >
        @if( $errors->any() )
        <div class="alert alert-danger">
            <ul>
                @foreach( $errors->all() as $error )
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(Session::has('error'))
        <div class="alert alert-danger">
        {{ Session::get('error')}}
        </div>
        @endif
        <form action="{{ route('authenticate') }}" method="POST" >
            @csrf
            <div class="mb-3 row">
                <label for="credential-email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" name="credentials[email]" class="form-control" id="credential-email" value="">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="credential-password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="password" name="credentials[password]" class="form-control" id="credential-password">
                </div>
            </div>
            <div class="mb-3 row pt-3">
                <div class="offset-sm-2 col-sm-2">
                    <input type="submit" class="form-control btn btn-primary" id="inputPassword" value="Login" >
                </div>
            </div>
        </form>
    </div>
</div>
@endsection