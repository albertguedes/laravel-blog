@extends('layouts.admin')
@section('title', "Edit '".ucwords($user->name)."'")
@section('content')
<div class="row card p-5 shadow" >
    <div class="card-body" >
        <div class="col-12" >
            <x-tabs-component prefix='users' :model=$user />
        </div>
        <div class="col-12 pt-5" >
            <h1 class="text-capitalize card-title" >Edit '{{ $user->name }}'</h1>
        </div>
        <div class="col-12" >
            <x-user-form-component action="{{ route( 'users.update', [ 'user' => $user ] ) }}" method="PUT" :user=$user :errors=$errors />
        </div>
    </div>
</div>
@endsection
