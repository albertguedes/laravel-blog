@extends('layouts.admin')
@section('title', "Edit Profile")
@section('content')
<div class="row card p-5 shadow" >
    <div class="card-body" >
        <div class="col-12" >
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('profile') }}" >Show</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('profile.edit',[ 'profile' => auth()->user() ]) }}" >Edit</a>
                </li>
            </ul>
        </div>
        <div class="col-12 pt-5" >
            <h1 class="text-capitalize card-title" >Edit Profile</h1>
        </div>
        <div class="col-12" >
            <x-profile-form-component action="{{ route( 'profile.update', [ 'profile' => auth()->user() ] ) }}" method="PUT" :profile="auth()->user()" :errors=$errors />
        </div>
    </div>
</div>
@endsection
