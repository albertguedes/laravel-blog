@extends('layouts.main')
@section('title','404 - Page not Found')
@section('description','Error 404 - Page Not Found on Server')
@section('content')
<article class="row" >
    <header class="col-12" >
        <x-page-title-component title="404 - Page Not Found" />
    </header>

    <section class="col-12" >
        <p>
            This page don't exist or has been moved. <a href="{{ route('home') }}" >Return to Home</a>
        </p>
    </section>

</article>
@endsection
