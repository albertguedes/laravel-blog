@extends('layouts.main')
@section('title', 'Profile - Post - Create')
@section('description','Form to create a post')
@section('content')
<section class="row" >

    <header class="col-12" >
        <x-page-title-component title="Profile - Post - Create" />
    </header>

    <aside class="col-3" >
        <x-profile.side-menu-component />
    </aside>

    <article class="col-9" >
        <x-posts.post-form-component action="{{ route('profile.post.store') }}" method="POST" :post=null />
    </article>

</section>
@endsection
