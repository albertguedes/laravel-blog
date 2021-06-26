@extends('layouts.admin')
@section('title', "Edit Profile")
@section('content')
<div class="row" >
    <div class="col-12" >
        @include('partials.admin.tabs',compact('routes'))
    </div>
    <div class="col-12 pt-5" >
        <h1 class="text-capitalize" >Edit Profile</h1>
    </div>
    <div class="col-12" >
        @include('partials.admin.profile.profileform',[ 
            'route' => route('profile.update'),
            'user'  => Auth::user(),
            'method' => 'PUT'
        ])
    </div>
</div>
@endsection