@extends('layouts.admin')
@section('title','Create User')
@section('content')
<div class="row" >
    <div class="col-12 pt-5" >
        <h1 class="text-capitalize" >Create User</h1>
    </div>
    <div class="col-12" >
        @include('partials.admin.users.userform',[ 'route' => route('users.store') ])
    </div>
</div>
@endsection