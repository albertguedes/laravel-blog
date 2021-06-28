@extends('layouts.main')
@section('title', 'Home')
@section('description','A simple blog made in laravel')
@section('content')
<div class="row" >
    @if(count($posts)>0)
        @foreach( $posts as $post )
        <div class="col-12 pb-5" >
            <h2><a href="{{ route('post',['post'=>$post]) }}" >{{ $post->title }}</a></h2>
            <h6 class="text-black-50" ><i class="fas fa-calendar-alt"></i> {{ $post->created_at->format("Y M d") }} by 
            <em>{{ ucwords($post->author->name) }}</em></h6>
            <div class="py-3" >
                {{ $post->description }}
                <p><a href="{{ route('post',['post'=>$post]) }}" >Read More</a></p>
            </div>
        </div>
        @endforeach
        <div class="d-flex justify-content-center pt-5">
            {!! $posts->links() !!}
        </div>
    @else
        <p>No posts.</p>
    @endif
</div>
@endsection