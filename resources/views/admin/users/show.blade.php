@extends('layouts.admin')
@section('title', ucwords($user->name) )
@section('content')
<div class="row" >
    <div class="col-12" >
        @include('partials.admin.tabs',compact('routes'))
    </div>
    <div class="col-12 pt-5" >
        <h1 class="text-capitalize" >{{ $user->name }}</h1>
        <h6 class="text-secondary" ><small>
            <i class="fas fa-calendar-plus"></i> {{ $user->created_at->format("Y-m-d h:i \h") }}
            <i class="fas fa-edit ps-3"></i> {{ $user->updated_at->format("Y-m-d h:i \h") }}
            </small>
        </h6>
    </div>
    <div class="col-12 pt-5" >
        <div class="w-25" >
            <div class="row" >
                <div class="col-4 pb-3 fw-bolder" >ID</div><div class="col-8" >{{ $user->id }}</div>
                <div class="col-4 pb-3 fw-bolder" >Is Active</div><div class="col-8" >@if($user->is_active)<span class="badge bg-success" >Yes</span>@else<span class="badge bg-danger" >No</span>@endif</div>                
                <div class="col-4 pb-3 fw-bolder" >Name</div><div class="col-8" >{{ $user->name }}</div>
                <div class="col-4 pb-3 fw-bolder" >Username</div><div class="col-8" >{{ $user->username }}</div>
                <div class="col-4 pb-3 fw-bolder" >Email</div><div class="col-8" ><a href="mailto:{{ $user->email }}" >{{ $user->email }}</a></div>
            </div>
        </div>
    </div>
</div>
@endsection
