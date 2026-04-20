<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') | Admin Laravel Blog</title>
        <script src="{{ asset('assets/vendor/FontAwesome/f761473b22.js') }}" ></script>
        <link href="{{ asset('assets/vendor/Bootstrap/bootstrap.min.css') }}" rel="stylesheet" >
        <link href="{{ asset('assets/css/fonts.css') }}" rel="stylesheet" >
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" >
        <link href="{{ asset('assets/css/footerbottom.css') }}" rel="stylesheet" >
        @stack('styles')
        <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">
        @stack('scripts')
    </head>
    <body>
        <main class="container" >
            <header class="row" >
                <div class="col-12 text-center" >
                    <h1 class="fw-bolder py-5" >
                        <a href="{{ route('home') }}" >
                            {{ env('APP_NAME') }}
                        </a>
                    </h1>
                </div>
            </header>
            <article class="row h-50 justify-content-center align-items-center" >
                <div class="col-12 text-center" >
                    <x-flash-messages-component />
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-4 col-xl-4 col-xxl-4" >
                    @yield('content')
                </div>
            </article>
        </main>
        <footer class="container-fluid fixed-bottom py-3" >
            <p class="text-center p-0 m-0" ><strong>Laravel Blog</strong> {{ date('Y') }} - <em>Free & Open Source.</em></p>
        </footer>
        <script type="text/javascript" src="{{ asset('assets/vendor/Jquery/jquery-3.7.1.min.js') }}" ></script>
        <script type="text/javascript" src="{{ asset('assets/vendor/Bootstrap/bootstrap.bundle.min.js') }}" ></script>
        <script src="{{ asset('assets/js/script.js') }}" ></script>
    </body>
</html>
