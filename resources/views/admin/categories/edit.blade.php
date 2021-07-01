@extends('layouts.admin')
@section('title', "Edit '".ucwords($category->title)."'")
@section('content')
<div class="row" >
    <div class="col-12" >
        @include('partials.admin.tabs',compact('routes'))
    </div>
    <div class="col-12 pt-5" >
        <h1 class="text-capitalize" >Edit '{{ $category->title }}'</h1>
    </div>
        @include('partials.admin.categories.categoryform',[ 
            'route'    => route('categories.update',compact('category')),
            'category' => $category,
            'method'   => 'PUT'
        ])
    </div>
</div>
@endsection