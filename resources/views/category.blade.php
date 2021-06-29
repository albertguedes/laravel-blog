@extends('layouts.main')
@section('title', strtoupper($category->title))
@section('description',$category->description)
@section('content')
<div class="row" >
    <div class="col-12 pb-3" >
        <h1 class="text-capitalize pb-3" >{{ $category->title }}</h1>
    </div>
    <div class="col-12 pt-3" >
        {{ $category->description }}
    </div>
    <div class="col-12 pt-3" >
        <ul>
            @foreach( $category->posts as $post )
            @if($post->published)
            <li class="py-2">
                <h5><a href="{{ route('post',compact('post')) }}" >{{ $post->title }}</a></h5>
                <h6 class="text-black-50 ps-3" >by <em>{{ ucwords($post->author->name) }}</em></h6>
            </li>
            @endif
            @endforeach
        </ul>
    </div>
</div>
@endsection