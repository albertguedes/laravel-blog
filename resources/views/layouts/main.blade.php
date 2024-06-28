<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" >
        <meta name="description" content="@yield('description')" >
        @php($title = View::getSections()['title'] ?? null)
        @if (is_null($title) || $title == 'Home')
            <title>{{ env('APP_NAME') }}</title>
        @else
            <title>@yield('title') | {{ env('APP_NAME') }}</title>
        @endif
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,400;0,700;0,800;1,400&display=swap" rel="stylesheet">
        <link href="{{ asset('assets/css/fonts.css') }}" rel="stylesheet" >
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" >
    </head>
    <body class="d-flex flex-column h-100">
        <main id="main" class="flex-shrink-0" >
            <div class="container" >
                <div class="row justify-content-center" >
                    <div class="col-11 col-sm-10 col-md-10 col-lg-8 col-xl-8 col-xxl-8 px-0" >
                        <header id="header" class="row pt-5" >
                            <div class="col-12 py-4 text-center text-md-start" >
                                @if( Request::url() == route('home') )
                                <h1 id="sitename" >
                                    <a href="{{ route('home') }}" >
                                        {{ env('APP_NAME') }}
                                    </a> <i data-eva="github"></i>
                                </h1>
                                @else
                                <div id="sitename" >
                                    <a href="{{ route('home') }}" >
                                        {{ env('APP_NAME') }}
                                    </a>
                                </div>
                                @endif
                            </div>
                        </header>
                        <article id="content" class="row" >
                            <div class="col-12 pt-5" >
                                @yield('content')
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </main>
        <footer id="#footer" class="container sticky-bottom my-5 py-5 border-top" >
            @include('partials.footer')
        </footer>
        <script src="{{ asset('assets/js/f761473b22.js') }}" ></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" ></script>
        <script src="{{ asset('assets/js/script.js') }}" ></script>
    </body>
</html>
