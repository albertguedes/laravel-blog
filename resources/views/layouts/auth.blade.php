<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') | Admin Laravel Blog</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
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
            <p class="text-center p-0 m-0" ><strong>Laravel Blog</strong> {{ date('Y') }} - <em>Free & Open Source.</em></p>
        </footer>
        <script src="https://kit.fontawesome.com/f761473b22.js" crossorigin="anonymous"></script>        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </body>
</html>
