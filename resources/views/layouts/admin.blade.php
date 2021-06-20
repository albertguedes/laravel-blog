<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') | Admin {{ env('APP_NAME') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" >
    </head>
    <body>
        <div class="container-fluid" >
            <div class="row" >
                <aside class="col-2 bg-dark shadow- fixed-top p-0 m-0 overflow-auto text-light" style="height:100%; min-height:100%;" >
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </body>
</html>
