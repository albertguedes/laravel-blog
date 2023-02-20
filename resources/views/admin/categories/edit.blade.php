@extends('layouts.admin')
@section('title', "Edit '".ucwords($category->title)."'")
@section('content')
<div class="row card shadow" >
    <div class="card-body">

        <div class="col-12" >
            <x-tabs-component prefix='categories' :model=$category />
        </div>

        <div class="col-12" >
            <h1 class="text-capitalize card-title" >Edit '{{ $category->title }}'</h1>
        </div>

        <div class="col-12" >
            <x-category-form-component action="{{ route('categories.update', [ 'category' => $category ] ) }}" method="PUT" :category=$category />
        </div>

    </div>
</div>
@endsection
