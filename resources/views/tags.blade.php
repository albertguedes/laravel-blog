@extends('layouts.main')
@section('title', 'Tags')
@section('description','Post tags')
@section('content')
<div class="row" >
    <div class="col-12 pb-3" >
        <h1 class="text-uppercase pb-3" >Tags</h1>
    </div>
    <div class="col-12" >
        @forelse( $tags as $tag )
        <a href="{{ route('tag',['tag'=>$tag]) }}" >{{ $tag->title }}</a>
        @empty
        <p>No tags created</p>
        @endforelse
    </div>
</div>
@endsection
