@extends('layouts.main')
@section('title', strtoupper($category->title))
@section('description',$category->description)
@section('content')
<div class="row" >
    <div class="col-12 pb-3" >
        <h1 class="text-capitalize pb-3" >{{ $category->title }}</h1>
    </div>
    <div class="col-12 pb-5" >
        {{ $category->description }}
    </div>
    <div class="col-12 pt-3" >
        <x-category-posts-component :category="$category" />
    </div>
</div>
@endsection
