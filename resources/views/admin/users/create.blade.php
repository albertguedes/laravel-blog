@extends('layouts.admin')
@section('title','Create User')
@section('content')
<div class="row card p-5 shadow" >
    <div class="card-body" >
        <div class="col-12" >
            <h1 class="text-capitalize card-title" >Create User</h1>
        </div>
        <div class="col-12" >
            <x-user-form-component action="{{ route('users.store') }}" method="POST" :user=null />
        </div>
    </div>
</div>
@endsection
