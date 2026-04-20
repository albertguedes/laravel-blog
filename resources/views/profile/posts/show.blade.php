@extends('layouts.main')
@section('title', 'Profile - Post')
@section('description',$post->description)
@section('content')
<section class="row" >

    <header class="col-12" >
        <x-page-title-component title="Profile - Post" />
    </header>

    <aside class="col-3" >
        <x-profile.side-menu-component />
    </aside>

    <article class="col-9" >
        <x-profile.posts.post-tabs-component :post="$post" />
        <x-profile.posts.show-post-component :post="$post" />
    </article>

</section>
@endsection
