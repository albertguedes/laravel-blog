<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') | Admin {{ env('APP_NAME') }}</title>
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" >
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" >
    </head>
    <body class="admin-body-bg" >
        <div class="container-fluid" >
            <div class="row" >
                <aside class="col-2 bg-dark fixed-top p-0 m-0 overflow-auto text-light" style="height:100%; min-height:100%;" >
                    @include("partials.admin.sidebar")
                </aside>
                <main class="offset-2 col-10 p-0 pb-5" >
                    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom p-0 m-0 px-2 mb-3">
                        @include("partials.admin.navbar")
                    </nav>
                    <article class="container-fluid px-4" >
                        @yield('content')
                    </article>
                </main>
                <footer class="offset-2 col-10 fixed-bottom px-0 bg-white" >
                        <p class="text-center p-0 py-2 m-0" ><strong>Laravel Blog</strong> {{ date('Y') }} - <em>Free & Open Source.</em></p>
                </footer>
            </div>
        </div>
        <script src="{{ asset('assets/js/f761473b22.js') }}" ></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" ></script>
    </body>
</html>
