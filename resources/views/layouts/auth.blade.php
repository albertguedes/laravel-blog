<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') | Admin Laravel Blog</title>
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" >
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,400;0,700;0,800;1,400&display=swap" rel="stylesheet">
        <link href="{{ asset('assets/css/fonts.css') }}" rel="stylesheet" >
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" >
    </head>
    <body>
        <main class="container" >
            <header class="row" >
                <div class="col-12 text-center" >
                    <h1 class="fw-bolder py-5" >
                        <a href="{{ route('home') }}" >
                            Admin {{ env('APP_NAME') }}
                        </a>
                    </h1>
                </div>
            </header>
            <article class="row d-flex justify-content-center" >
                <div class="w-25" >
                    @yield('content')
                </div>
            </article>
        </main>
        <footer class="container-fluid fixed-bottom py-3" >
            <p class="text-center p-0 m-0" ><strong>Admin Laravel Blog</strong> {{ date('Y') }} - <em>Free & Open Source.</em></p>
        </footer>
        <script src="{{ asset('assets/js/f761473b22.js') }}" ></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" ></script>
        <script src="{{ asset('assets/js/script.js') }}" ></script>
    </body>
</html>
