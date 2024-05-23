@extends('layouts.admin')
@section('title','Create Post')
@section('content')
<div class="row card p-5 shadow" >
    <div class="card-body" >
        <div class="col-12 py-2" >
            <h1 class="text-capitalize card-title" >Create Post</h1>
        </div>
        <div class="col-12 py-2" >
            <x-post-form-component action="{{ route('posts.store') }}" method="POST" :post=null />
        </div>
    </div>
</div>
@endsection
