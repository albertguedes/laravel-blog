@extends('layouts.main')
@section('title', 'Profile - Post - Edit')
@section('description','Form to edit a post')
@section('content')
<section class="row" >

    <header class="col-12" >
        <x-page-title-component title="Profile - Post - Edit" />
    </header>

    <aside class="col-3" >
        <x-profile.side-menu-component />
    </aside>

    <article class="col-9" >
        <x-profile.posts.post-tabs-component :post="$post" />
        <x-posts.post-form-component action="{{ route('profile.post.update', compact('post')) }}" method="PUT" :post="$post" />
    </article>

</section>
@endsection
