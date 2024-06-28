@extends('layouts.admin')
@section('title', "Edit '".ucwords($tag->title)."'")
@section('content')
<div class="row card p-5 shadow" >
    <div class="col-12" >
        @include('partials.admin.tabs',compact('routes'))
    </div>
    <div class="col-12 pt-5" >
        <h1 class="text-capitalize card-title" >Edit '{{ $tag->title }}'</h1>
    </div>
        @include('partials.admin.tags.tagform',[
            'route'    => route('tags.update',compact('tag')),
            'tag' => $tag,
            'method'   => 'PUT'
        ])
    </div>
</div>
@endsection
