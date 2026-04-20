@extends('layouts.main')
@section('title', 'Profile - Password')
@section('content')
<section class="row" >

    <header class="col-12" >
        <x-page-title-component title="Profile - Password" />
    </header>

    <aside class="col-3" >
        <x-profile.side-menu-component />
    </aside>

    <article class="col-9" >

        <div class="alert alert-warning text-center" role="alert">
            <h2>
                <i class="fas fa-exclamation-triangle"></i> You are about to change your password.
            </h2>
        </div>

        <x-profile.password-form-component />

    </article>

</section>
@endsection

