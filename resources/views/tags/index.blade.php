@extends('layouts.main')
@section('title', 'Tags')
@section('description','Post tags')
@section('content')
<section class="row" vocab="https://schema.org/" typeof="CollectionPage">

    <header class="col-12" property="name">
        <x-page-title-component title="Tags" icon="tag" />
    </header>

    <article class="col-12" property="mainEntity" typeof="ItemList">
        <x-tags.cloud-component :tags="$tags" />
    </article>

</section>
@endsection
