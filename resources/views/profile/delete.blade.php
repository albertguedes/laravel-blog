@extends('layouts.main')
@section('title', 'Profile - Cancel Account')
@section('content')
<section class="row" >

    <header class="col-12" >
        <x-page-title-component title="Profile - Cancel Account" />
    </header>

    <aside class="col-3" >
        <x-profile.side-menu-component />
    </aside>

    <article class="col-9" >
        <div class="row" >

            <div class="col-12 pt-3" >
                <div class="alert alert-warning text-center" role="alert">
                    <h2>
                        <i class="fas fa-exclamation-triangle"></i> Once you delete your account, there is no going back.
                    </h2>
                    <p class="alert-heading">Are you sure?</p>
                </div>
            </div>

            <div class="col-6" >
                <a href="{{ route('profile') }}" class="btn btn-success btn-lg w-100 py-4">
                    <div class="row" >
                        <div class="col-3 d-flex align-items-center justify-content-center text-center h1" >
                            <i class="fa fa-arrow-left"></i>
                        </div>
                        <div class="col-9" >
                            No, i want to keep my account
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-6 justify-content-center" >

                <form class="p-0 m-0" action="{{ route('profile.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-lg py-4 w-100">
                        <div class="row" >
                            <div class="col-3 d-flex align-items-center justify-content-center text-center h1" >
                                <i class="fa fa-trash"></i>
                            </div>
                            <div class="col-9" >
                                Yes, i want to delete my account
                            </div>
                        </div>
                    </button>
                </form>
            </div>

        </div>
    </article>

</section>
@endsection

