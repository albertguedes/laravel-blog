@extends('layouts.admin')
@section('title', ucwords($user->name) )
@section('content')
<div class="row" >
    <div class="col-12" >
        @include('partials.admin.tabs',compact('routes'))
    </div>
    <div class="col-12 pt-5" >
        <h1 class="text-capitalize" >{{ $user->name }}</h1>
    </div>
    <div class="col-12 pt-5" >
        <div class="w-25" >
            <div class="row" >
                <div class="col-2 fw-bolder" >ID</div><div class="col-10" >{{ $user->id }}</div>
                <div class="col-2 fw-bolder" >Name</div><div class="col-10" >{{ $user->name }}</div>
                <div class="col-2 fw-bolder" >Email</div><div class="col-10" >{{ $user->email }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
