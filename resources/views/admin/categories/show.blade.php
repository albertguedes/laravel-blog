@extends('layouts.admin')
@section('title', ucwords($category->title) )
@section('content')
<div class="row card shadow" >
    <div class="card-body" >
        <div class="col-12" >
            @include('partials.admin.tabs',compact('routes'))
        </div>
        <div class="col-12 py-3" >
            <h1 class="text-capitalize card-title" >{{ $category->title }}</h1>
            <h6 class="text-secondary" >
                <small>
                    <i class="fas fa-calendar-plus"></i> {{ $category->created_at->format("Y-m-d h:i \h") }}
                    <i class="fas fa-edit ps-3"></i> {{ $category->updated_at->format("Y-m-d h:i \h") }}
                </small>
            </h6>
        </div>
        <div class="col-12 py-2" >
            <div class="w-50" >
                <div class="row" >
                    <div class="col-3 pb-3 fw-bolder" >ID</div><div class="col-9 pb-3" >{{ $category->id }}</div>
                    <div class="col-3 pb-3 fw-bolder" >Parent</div><div class="col-9 pb-3" >@if($category->parent)<a href="{{ route('categories.show',['category'=>$category->parent]) }}" >{{ $category->parent->title }}</a>@else-@endif</div>
                    <div class="col-3 pb-3 fw-bolder" >Is Active</div><div class="col-9 pb-3 " >@if($category->is_active)<span class="badge bg-success" >Yes</span>@else<span class="badge bg-danger" >No</span>@endif</div>
                    <div class="col-3 pb-3 fw-bolder" >Slug</div><div class="col-9 pb-3 " >{{ $category->slug }}</div>
                    <div class="col-3 pb-3 fw-bolder" >Title</div><div class="col-9 pb-3 " >{{ $category->title }}</div>
                    <div class="col-3 pb-3 fw-bolder" >Description</div><div class="col-9 pb-3 " >{{ $category->description }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
