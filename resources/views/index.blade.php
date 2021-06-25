@extends('layouts.main')
@section('title', 'Home')
@section('content')
<div class="row" >
    @if(count($posts)>0)
        @foreach( $posts as $post )
        <div class="col-12 pb-5" >
            <h2><a href="{{ route('post',['post'=>$post]) }}" >{{ $post->title }}</a></h2>
            <h6 class="text-black-50" >{{ $post->created_at->format("Y M d") }}</h6>
            <div class="py-3" >
                {{ substr($post->content,0,140) }} ...
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