@extends('layouts.main')
@section('title', 'Profile - Posts')
@section('description','A list of posts of user')
@section('content')
<section class="row" >

    <header class="col-12" >
        <x-common.page-title title="Profile - Posts" />
    </header>

    <aside class="col-3" >
        <x-side-menu />
    </aside>

    <article class="col-9" >
        <x-posts-list :posts="$posts" />
    </article>

</section>
@endsection
