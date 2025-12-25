@extends('layouts.main')
@section('title', 'Categories')
@section('description','Posts categories')
@section('content')
<section class="row" >

    <header class="col-12" >
        <x-page-title-component title="Categories" icon="sitemap" />
    </header>

    <article class="col-12" >
        <x-categories.tree-component />
    </article>

</section>
@endsection

@push('footer_scripts')
<script type="text/javascript" src="{{ asset('assets/js/pages/categories/index.js') }}" ></script>
@endpush
