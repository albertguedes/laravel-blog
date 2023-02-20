@extends('layouts.admin')
@section('title','Create Post')
@section('content')
<div class="row card shadow" >
    <div class="card-body" >

        <div class="col-12" >
            <h1 class="text-capitalize card-title" >Create Post</h1>
        </div>

        <div class="col-12" >
            <x-category-form-component action="{{ route('categories.store') }}" method="POST" :category=null />
        </div>

    </div>
</div>
@endsection
