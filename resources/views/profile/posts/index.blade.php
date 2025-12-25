@extends('layouts.main')
@section('title', 'Profile - Posts')
@section('description','A list of posts of user')
@section('content')
<section class="row" >

    <header class="col-12" >
        <x-page-title-component title="Profile - Posts" />
    </header>

    <aside class="col-3" >
        <x-profile.side-menu-component />
    </aside>

    <article class="col-9" >
        <x-profile.posts.posts-list-component :posts="$posts" />
    </article>

</section>
@endsection
