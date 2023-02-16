@extends('layouts.admin')
@section('title', "Edit '".ucwords($category->title)."'")
@section('content')
<div class="row card" >
    <div class="card-body">

        <div class="col-12 py-2" >
            @include('partials.admin.tabs',compact('routes'))
        </div>

        <div class="col-12 py-3" >
            <h1 class="text-capitalize card-title" >Edit '{{ $category->title }}'</h1>
        </div>

        @include('partials.admin.categories.categoryform',[
                'route'    => route('categories.update',compact('category')),
                'category' => $category,
                'method'   => 'PUT'
        ])

    </div>
</div>
@endsection
