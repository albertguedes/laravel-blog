@extends('layouts.admin')
@section('title','Create Post')
@section('content')
<div class="row card shadow" >
    <div class="card-body" >
        <div class="col-12 py-2" >
            <h1 class="text-capitalize card-title" >Create Post</h1>
        </div>
        <div class="col-12 py-2" >
            @include('partials.admin.posts.postform',[
                'route'  => route('posts.store'),
                'post'   => null,
                'method' => 'POST'
            ])
        </div>
    </div>
</div>
@endsection
