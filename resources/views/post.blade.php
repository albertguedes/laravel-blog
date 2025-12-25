@extends('layouts.main')
@section('title', strtoupper($post->title))
@section('description',$post->description)
@section('content')
<section class="row" >

    <header class="col-12" >

        <x-page-title-component :title="$post->title" />

        <h6 class="text-black-50" >
            <i class="fas fa-calendar-alt"></i> {{ $post->created_at->format("Y M d") }}
            by <x-authors.link :author-id="$post->author->id" />
        </h6>

    </header>

    <article class="col-12 py-5" >
        {{ $post->content }}
    </article>

    <footer class="col-12" >
        <div class="row" >

            @if( $post->category )
            <div class="col-6 py-3" >
                <a href="{{ route('category',['category'=>$post->category]) }}" ><i class="fas fa-sitemap"></i> {{ $post->category->title }}</a>
            </div>
            @endif

            @if( $post->tags()->count() )
            <div class="col-6 py-3" >
                @foreach ($post->tags as $tag)
                <a class="me-2 d-inline-flex align-items-center" href="{{ route('tag', compact('tag')) }}">
                    <i class="fas fa-tag"></i><span class="hidden-char" >...</span>{{ $tag->title }}
                </a>
                @endforeach
            </div>
            @endif

        </div>
    </footer>

</section>
@endsection
