@extends('layouts.main')
@section('title', 'Home')
@section('description','A simple blog made in laravel')
@section('content')
<div class="row" >
    <x-latest-posts-component />
</div>
@endsection
