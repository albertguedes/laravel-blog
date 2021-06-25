@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="row" >
    <div class="col-12 pt-5" >
        <p>Wellcome to dashboard.</p>
    </div>
    <div class="col-3 pt-5" >
        <div class="card text-white bg-primary w-10">
            <div class="card-header">
                Users
            </div>
            <div class="card-body">
                <h5 class="card-title">Number of users</h5>
                <p class="card-text">{{ $num_users }}</p>
                <a href="{{ route('users.index') }}" class="btn btn-light">Go somewhere</a>
            </div>
        </div>
    </div>
    <div class="col-3 pt-5" >
        <div class="card text-white bg-success w-10">
            <div class="card-header">
                Posts
            </div>
            <div class="card-body">
                <h5 class="card-title">Number of posts</h5>
                <p class="card-text">{{ $num_posts }}</p>
                <a href="{{ route('posts.index') }}" class="btn btn-light">Go somewhere</a>
            </div>
        </div>
    </div>
</div>
@endsection