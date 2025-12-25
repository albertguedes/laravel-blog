@extends('layouts.main')
@section('title', 'Home')
@section('description','A simple blog made in laravel')
@section('content')
<section class="row" vocab="http://schema.org/" typeof="CreativeWork">

    @if(count($posts)>0)

        @foreach( $posts as $post )
        <div class="col-12" property="mainEntity" typeof="BlogPosting">
            <x-post-details-component :post="$post" />
        </div>
        @endforeach

        <div class="col-12 d-flex justify-content-center pt-5">
            {!! $posts->links() !!}
        </div>

    @else
    <div class="col-12" >
        <p>No posts.</p>
    </div>
    @endif

</section>
@endsection
