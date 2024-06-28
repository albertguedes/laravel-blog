@extends('layouts.main')
@section('title', 'Tags')
@section('description','Post tags')
@section('content')
<div class="row" >
    <div class="col-12 pb-3" >
        <h1 class="text-uppercase pb-3" ><i class="fas fa-tag"></i> Tags</h1>
    </div>
    <div class="col-12" >
        <x-tag-cloud-component />
    </div>
</div>
@endsection
