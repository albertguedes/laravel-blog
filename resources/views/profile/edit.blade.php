@extends('layouts.main')
@section('title', 'Profile - Edit')
@section('content')
<section class="row" >

    <header class="col-12" >
        <x-page-title-component title="Profile - Edit" />
    </header>

    <aside class="col-3" >
        <x-profile.side-menu-component />
    </aside>

    <article class="col-9" >
        <div class="row" >

            <div class="col-12 mb-5" >
                <x-profile.profile-edit-form-component :user="$user" />
            </div>

            <div class="col-12 mb-5" >
                <div class="card" >
                    <div class="card-body" >
                        <p class="card-text h6" >
                            Click <a href="{{ route('profile.delete') }}" class="text-danger text-decoration-underline" >here</a> if you want to cancel your account.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </article>

</section>
@endsection

