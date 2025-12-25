@extends('layouts.main')
@section('title', 'Archive')
@section('description','Archive of all posts')
@section('content')
<section class="row" >

    <header class="col-12">
        <x-page-title-component title="Archive" icon="archive" />
    </header>

    <article class="col-12" >
        <x-posts.archive-component :year="$year" :month="$month" :day="$day" />
    </article>

</section>
@endsection
