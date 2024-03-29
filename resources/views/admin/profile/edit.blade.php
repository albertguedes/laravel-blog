@extends('layouts.admin')
@section('title', "Edit Profile")
@section('content')
<div class="row card shadow" >
    <div class="card-body" >
        <div class="col-12" >
            @include('partials.admin.tabs',compact('routes'))
        </div>
        <div class="col-12" >
            <h1 class="text-capitalize card-title" >Edit Profile</h1>
        </div>
        <div class="col-12" >
            @include('partials.admin.profile.profileform',[
                'route'  => route('profile.update'),
                'user'   => Auth::user(),
                'method' => 'PUT'
            ])
        </div>
    </div>
</div>
@endsection
