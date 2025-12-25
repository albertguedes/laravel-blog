@extends('layouts.main')
@section('title', 'Profile - Post - Delete')
@section('description','Form to edit a post')
@section('content')
<section class="row" >

    <header class="col-12" >
        <x-page-title-component title="Profile - Post - Delete" />
    </header>

    <aside class="col-3" >
        <x-profile.side-menu-component />
    </aside>

    <article class="col-9" >

        <x-profile.posts.post-tabs-component :post="$post" />

        <div class="row" >

            <div class="col-12 pb-3" >
                <div class="alert alert-warning text-center" role="alert">
                    <h2><i class="fas fa-exclamation-triangle"></i> Once you delete this post, there is no going back.</h2>
                    <p class="alert-heading">Are you sure?</p>
                </div>
            </div>

            <div class="col-6 text-end">
                <a href="{{ route('profile.post', compact('post')) }}" class="btn btn-lg btn-primary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>

            <div class="col-6 text-start">
                <form class="p-0 m-0" action="{{ route('profile.post.destroy', compact('post')) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-lg btn-danger">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>

        </div>
    </article>

</section>
@endsection
