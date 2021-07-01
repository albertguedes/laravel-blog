@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="row" >
    <div class="col-12 pt-5" >
        <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
            <div class="col-md-6 px-0">
                <h1 class="display-4 fst-italic">Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-3 pt-5" >
        <div class="card text-white bg-primary w-10">
            <div class="card-header">
                Users
            </div>
            <div class="card-body">
                <h5 class="card-title">Number of users</h5>
                <p class="card-text">{{ $num_users }}</p>
                <a href="{{ route('users.index') }}" class="btn btn-light"><i class="fas fa-list-ol"></i> List</a>
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
                <a href="{{ route('posts.index') }}" class="btn btn-light"><i class="fas fa-list-ol"></i> List</a>
            </div>
        </div>
    </div>
    <div class="col-3 pt-5" >
        <div class="card text-white bg-danger w-10">
            <div class="card-header">
                Categories
            </div>
            <div class="card-body">
                <h5 class="card-title">Number of categories</h5>
                <p class="card-text">{{ $num_categories }}</p>
                <a href="{{ route('categories.index') }}" class="btn btn-light"><i class="fas fa-list-ol"></i> List</a>
            </div>
        </div>
    </div>
</div>
@endsection