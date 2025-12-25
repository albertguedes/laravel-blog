@extends('layouts.main')
@section('title', 'Profile')
@section('content')
<section class="row" >

    <header class="col-12" >
        <x-page-title-component title="Profile" />
    </header>

    <aside class="col-3" >
        <x-profile.side-menu-component />
    </aside>

    <article class="col-9" >
        <x-profile.profile-component :user="$user" />
    </article>

</section>
@endsection

