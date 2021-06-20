@extends('layouts.admin')
@section('title', "Edit '".ucwords($user->name)."'")
@section('content')
<div class="row" >
    <div class="col-12" >
        @include('partials.admin.tabs',compact('routes'))
    </div>
    <div class="col-12 pt-5" >
        <h1 class="text-capitalize" >Edit '{{ $user->name }}'</h1>
    </div>
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
        @include('partials.admin.users.userform',[ 
            'route' => route('users.update',compact('user')), 
            'user'  => $user,
            'method' => 'PUT'
        ])
    </div>
</div>
@endsection