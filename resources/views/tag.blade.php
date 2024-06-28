@extends('layouts.main')
@section('title', strtoupper($tag->title))
@section('description',$tag->description)
@section('content')
<div class="row" >
    <div class="col-12 pb-3" >
        <h1 class="text-capitalize pb-3" ><i class="fas fa-tag"></i> {{ $tag->title }}</h1>
    </div>
    <div class="col-12 pb-5" >
        {{ $tag->description }}
    </div>
    <div class="col-12 pt-3" >
        <x-tag-posts-component :tag="$tag" />
    </div>
</div>
@endsection
