@extends('layouts.main')
@section('title', 'Categories')
@section('description','Posts categories')
@section('content')
<div class="row" >
    <div class="col-12 pb-3" >
        <h1 class="text-uppercase pb-3" >Categories</h1>
    </div>
    <div class="col-12" >
        <x-tree-category-component />
    </div>
</div>
@endsection
