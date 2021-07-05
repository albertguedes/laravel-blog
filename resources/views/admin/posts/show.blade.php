@extends('layouts.admin')
@section('title', ucwords($post->title) )
@section('content')
<div class="row" >
    <div class="col-12" >
        @include('partials.admin.tabs',compact('routes'))
    </div>
    <div class="col-12 pt-5" >
        <h1 class="text-capitalize" >{{ $post->title }}</h1>
        <h6 class="text-secondary" >
            <small>
                <i class="fas fa-calendar-plus"></i> {{ $post->created_at->format("Y-m-d h:i \h") }}
                <i class="fas fa-edit ps-3"></i> {{ $post->updated_at->format("Y-m-d h:i \h") }}
                <i class="fas fa-user ps-3"></i> {{ ucwords($post->author->name) }}
            </small>
        </h6>
    </div>
    <div class="col-12 pt-5" >
        <div class="w-50" >
            <div class="row" >
                <div class="col-3 pb-3 fw-bolder" >ID</div><div class="col-9 pb-3" >{{ $post->id }}</div>
                <div class="col-3 pb-3 fw-bolder" >Published</div><div class="col-9 pb-3 " >@if($post->published)<span class="badge bg-success" >Yes</span>@else<span class="badge bg-danger" >No</span>@endif</div>
                <div class="col-3 pb-3 fw-bolder" >Slug</div><div class="col-9 pb-3 " >{{ $post->slug }}</div>
                <div class="col-3 pb-3 fw-bolder" >Category</div><div class="col-9 pb-3 " ><a href="{{ route('categories.show',['category'=>$post->category])}}" >{{ $post->category->title }}</a></div>
                <div class="col-3 pb-3 fw-bolder" >Title</div><div class="col-9 pb-3 " >{{ $post->title }}</div>
                <div class="col-3 pb-3 fw-bolder" >Description</div><div class="col-9 pb-3 " >{{ $post->description }}</div>
                <div class="col-3 pb-3 fw-bolder" >Content</div><div class="col-9 pb-3 " >{{ $post->content }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
