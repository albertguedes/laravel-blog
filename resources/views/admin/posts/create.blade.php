@extends('layouts.admin')
@section('title','Create Post')
@section('content')
<div class="row" >
    <div class="col-12 pt-5" >
        <h1 class="text-capitalize" >Create Post</h1>
    </div>
    <div class="col-12" >
        @include('partials.admin.posts.postform',[ 
            'route' => route('posts.store') 
        ])
    </div>
</div>
@endsection