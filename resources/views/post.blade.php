@extends('layouts.main')
@section('title', strtoupper($post->title))
@section('description',$post->description)
@section('content')
<div class="row" >
    <div class="col-12 pb-3" >
        <h1 class="text-uppercase pb-3" >{{ $post->title }}</h1>
        <h6 class="text-black-50" >
            <i class="fas fa-calendar-alt"></i> {{ $post->created_at->format("Y M d") }}
            by <em>{{ ucwords($post->author->name) }}</em>
        </h6>
    </div>
    <div class="col-12 py-3" >
        {{ $post->content }}
    </div>
    <div class="col-12 py-3" >
        <a href="{{ route('category',['category'=>$post->category]) }}" ><i class="fas fa-sitemap"></i> {{ $post->category->title }}</a>
    </div>
</div>
@endsection