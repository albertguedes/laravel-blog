@extends('layouts.admin')
@section('title', ucwords($post->title) )
@section('content')
<div class="row" >
    <div class="col-12" >
        @include('partials.admin.tabs',compact('routes'))
    </div>
    <div class="col-12 pt-5" >
        <h1 class="text-capitalize" >{{ $post->title }}</h1>
    </div>
    <div class="col-12 pt-5" >
        <div class="w-50" >
            <div class="row" >
                <div class="col-3 fw-bolder" >ID</div><div class="col-9" >{{ $post->id }}</div>
                <div class="col-3 fw-bolder" >Title</div><div class="col-9" >{{ $post->title }}</div>
                <div class="col-3 fw-bolder" >Content</div>
                <div class="col-9" >{{ $post->content }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
