@extends('layouts.main')
@section('title', strtoupper($tag->title))
@section('description',$tag->description)
@section('content')
<section class="row" >

    <header class="col-12" >
        <x-page-title-component :title="$tag->title" icon="tag" />
    </header>

    <section class="col-12 mb-5 h6 fst-italic" >
        {{ $tag->description }}
    </section>

    <article class="col-12" >
        <x-tags.posts-component :tag="$tag" />
    </article>

</section>
@endsection
