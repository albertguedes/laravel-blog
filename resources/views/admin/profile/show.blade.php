@extends('layouts.admin')
@section('title', 'Profile' )
@section('content')
<div class="row" >
    <div class="col-12" >
        @include('partials.admin.tabs',compact('routes'))
    </div>
    <div class="col-12 pt-5" >
        <h1 class="text-capitalize" >Profile</h1>
        <h6 class="text-secondary" ><small>
            <i class="fas fa-calendar-plus"></i> {{ auth()->user()->created_at->format("Y-m-d h:i \h") }}
            <i class="fas fa-edit ps-3"></i> {{ auth()->user()->updated_at->format("Y-m-d h:i \h") }}
            </small>
        </h6>
    </div>
    <div class="col-12 pt-5" >
        <div class="w-25" >
            <div class="row" >
                <div class="col-4 pb-3 fw-bolder" >ID</div><div class="col-8" >{{ auth()->user()->id }}</div>
                <div class="col-4 pb-3 fw-bolder" >Name</div><div class="col-8" >{{ auth()->user()->name }}</div>
                <div class="col-4 pb-3 fw-bolder" >Username</div><div class="col-8" >{{ auth()->user()->username }}</div>
                <div class="col-4 pb-3 fw-bolder" >Email</div><div class="col-8" >{{ auth()->user()->email }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
