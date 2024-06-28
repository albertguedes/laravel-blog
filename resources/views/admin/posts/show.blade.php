@extends('layouts.admin')
@section('title', ucwords($post->title) )
@section('content')
<div class="row card p-5 shadow" >
    <div class="card-body" >
        <div class="col-12" >
            <x-tabs-component prefix='posts' :model=$post />
        </div>
        <div class="col-12 py-5" >
            <h1 class="text-capitalize card-title" >{{ $post->title }}</h1>
            <h6 class="text-secondary" >
                <small>
                    <i class="fas fa-calendar-plus"></i> {{ $post->created_at->format("Y-m-d h:i \h") }}
                    <i class="fas fa-edit ps-3"></i> {{ $post->updated_at->format("Y-m-d h:i \h") }}
                    <i class="fas fa-user ps-3"></i>
                    @if(Auth::user()->is_admin)
                    <a href="{{ route('users.show',[ 'user' => $post->author->id ] ) }}" >{{ ucwords($post->author->name) }}</a>
                    @else
                    {{ ucwords($post->author->name) }}
                    @endif
                </small>
            </h6>
        </div>
        <div class="col-12" >
            <div class="row" >

                <div class="col-1 pb-3 fw-bolder" >ID</div>
                <div class="col-11 pb-3" >{{ $post->id }}</div>

                <div class="col-1 pb-3 fw-bolder" >Published</div>
                <div class="col-11 pb-3 " >@if($post->published)<span class="badge bg-success" >Yes</span>@else<span class="badge bg-danger" >No</span>@endif</div>

                <div class="col-1 pb-3 fw-bolder" >Slug</div>
                <div class="col-11 pb-3 " ><a href="{{ route('post', ['post' => $post->slug ]) }}" >{{ $post->slug }}</a></div>

                <div class="col-1 pb-3 fw-bolder" >Category</div>
                <div class="col-11 pb-3 " >
                    @if($post->category)
                    <a href="{{ route('categories.show',[ 'category' => $post->category ]) }}" >{{ $post->category->title }}</a>
                    @else
                    no categorized
                    @endif
                </div>

                <div class="col-1 pb-3 fw-bolder" >Tags</div>
                <div class="col-11 pb-3 " >
                    @if($post->tags->count() > 0)
                        @foreach($post->tags as $tag)
                        <a href="{{ route('tags.show',[ 'tag' => $tag ]) }}" >{{ $tag->title }}</a>,&nbsp;
                        @endforeach
                    @else
                        no tagged
                    @endif
                </div>

                <div class="col-1 pb-3 fw-bolder" >Title</div>
                <div class="col-11 pb-3 " >{{ $post->title }}</div>

                <div class="col-12 pb-3 fw-bolder" >Description</div>
                <div class="col-12 pb-3 " >{{ $post->description }}</div>

                <div class="col-12 pb-3 fw-bolder" >Content</div>
                <div class="col-12 pb-3 " >{{ $post->content }}</div>

            </div>
        </div>
    </div>
</div>
@endsection
