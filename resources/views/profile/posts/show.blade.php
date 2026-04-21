@extends('layouts.main')
@section('title', 'Profile - Post')
@section('description',$post->description)
@section('content')
<section class="row" >

    <header class="col-12" >
        <x-common.page-title title="Profile - Post" />
    </header>

    <aside class="col-3" >
        <x-common.side-menu />
    </aside>

    <article class="col-9" >
        <x-common.post-tabs :post="$post" />
        <x-common.show-post :post="$post" />
    </article>

</section>
@endsection
