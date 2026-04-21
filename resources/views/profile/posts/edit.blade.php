@extends('layouts.main')
@section('title', 'Profile - Post - Edit')
@section('description','Form to edit a post')
@section('content')
<section class="row" >

    <header class="col-12" >
        <x-common.page-title title="Profile - Post - Edit" />
    </header>

    <aside class="col-3" >
        <x-side-menu />
    </aside>

    <article class="col-9" >
        <x-post-tabs :post="$post" />
        <x-post-form action="{{ route('profile.post.update', compact('post')) }}" method="PUT" :post="$post" />
    </article>

</section>
@endsection
