@extends('layouts.main')
@section('title', 'Archive')
@section('description','Archive of all posts')
@section('content')
<div class="row" >
<div class="col-12 pb-5">
        <h2 class="text-uppercase" ><i class="fas fa-archive"></i> Archive</h2>
    </div>
    <div class="col-12" >
        <x-archive-component :year="$year" :month="$month" :day="$day" />
    </div>
</div>
@endsection
