@extends('layouts.admin')
@section('title', ucwords($tag->title) )
@section('content')
<div class="row" >
    <div class="col-12" >
        @include('partials.admin.tabs',compact('routes'))
    </div>
    <div class="col-12 pt-5" >
        <h1 class="text-capitalize" >{{ $tag->title }}</h1>
        <h6 class="text-secondary" >
            <small>
                <i class="fas fa-calendar-plus"></i> {{ $tag->created_at->format("Y-m-d h:i \h") }}
                <i class="fas fa-edit ps-3"></i> {{ $tag->updated_at->format("Y-m-d h:i \h") }}
            </small>
        </h6>
    </div>
    <div class="col-12 pt-5" >
        <div class="w-50" >
            <div class="row" >
                <div class="col-3 pb-3 fw-bolder" >ID</div><div class="col-9 pb-3" >{{ $tag->id }}</div>
                <div class="col-3 pb-3 fw-bolder" >Is Active</div><div class="col-9 pb-3 " >@if($tag->is_active)<span class="badge bg-success" >Yes</span>@else<span class="badge bg-danger" >No</span>@endif</div>
                <div class="col-3 pb-3 fw-bolder" >Slug</div><div class="col-9 pb-3 " >{{ $tag->slug }}</div>
                <div class="col-3 pb-3 fw-bolder" >Title</div><div class="col-9 pb-3 " >{{ $tag->title }}</div>
                <div class="col-3 pb-3 fw-bolder" >Description</div><div class="col-9 pb-3 " >{{ $tag->description }}</div>
             </div>
        </div>
    </div>
</div>
@endsection
