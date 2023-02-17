@extends('layouts.admin')
@section('title','Create Post')
@section('content')
<div class="row card shadow" >
    <div class="card-body" >
        <div class="col-12 pt-5" >
            <h1 class="text-capitalize" >Create Post</h1>
        </div>
        <div class="col-12" >
            @include('partials.admin.categories.categoryform',[
                'route'    => route('categories.store'),
                'category' => null,
                'method'   => 'POST'
            ])
        </div>
    </div>
</div>
@endsection
