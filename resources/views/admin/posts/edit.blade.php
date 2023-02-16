@extends('layouts.admin')
@section('title', "Edit '".ucwords($post->title)."'")
@section('content')
<div class="row card shadow" >
    <div class="card-body" >
        <div class="col-12" >
            @include('partials.admin.tabs',compact('routes'))
        </div>
        <div class="col-12 pt-5" >
            <h1 class="text-capitalize" >Edit '{{ $post->title }}'</h1>
        </div>
            @include('partials.admin.posts.postform',[
                'route'  => route('posts.update',compact('post')),
                'post'   => $post,
                'method' => 'PUT'
            ])
        </div>
    </div>
</div>
@endsection
