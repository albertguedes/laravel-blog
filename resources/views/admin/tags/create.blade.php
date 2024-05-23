@extends('layouts.admin')
@section('title','Create Post')
@section('content')
<div class="row card p-5 shadow" >
    <div class="col-12" >
        <h1 class="text-capitalize card-title" >Create Post</h1>
    </div>
    <div class="col-12" >
        @include('partials.admin.tags.tagform',[
            'route' => route('tags.store')
        ])
    </div>
</div>
@endsection
