@extends('layouts.admin')
@section('title', "Edit '".ucwords($post->title)."'")
@section('content')
<div class="row card shadow" >
    <div class="card-body" >
        <div class="col-12" >
            <x-tabs-component prefix='posts' :model=$post />
        </div>
        <div class="col-12 pt-5" >
            <h1 class="text-capitalize" >Edit '{{ $post->title }}'</h1>
        </div>
            <x-post-form-component action="{{ route('posts.update',compact('post') ) }}" method="PUT" :post=$post />
        </div>
    </div>
</div>
@endsection
