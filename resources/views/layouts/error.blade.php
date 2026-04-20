<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" vocab="https://schema.org/" typeof="WebSite">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" >
        <meta name="description" content="@yield('description')" >
        @php($title = View::getSections()['title'] ?? null)
        <title>
        @if (is_null($title) || $title == 'Home')
            {{ env('APP_NAME') }}
        @else
            @yield('title') | {{ env('APP_NAME') }}
        @endif
        </title>
        <script type="application/ld+json" >
            {
                "@context": "https://schema.org",
                "@type": "WebSite",
                "name": "{{ env('APP_NAME') }}",
                "url": "{{ url('/') }}",
                "description": "{{ env('APP_TAGLINE') }}",
                "author": {
                    "@type": "Person",
                    "name": "{{ env('APP_AUTHOR') }}"
                }
            }
        </script>
        <script src="{{ asset('assets/vendor/FontAwesome/f761473b22.js') }}" ></script>
        <link href="{{ asset('assets/vendor/Bootstrap/bootstrap.min.css') }}" rel="stylesheet" >
        <link href="{{ asset('assets/css/fonts.css') }}" rel="stylesheet" >
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" >
        <link href="{{ asset('assets/css/footerbottom.css') }}" rel="stylesheet" >
        @stack('styles')
        <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">
        @stack('scripts')
    </head>
    <body class="d-flex flex-column h-100" itemscope itemtype="http://schema.org/WebSite">
        <main id="main" class="flex-shrink-0" itemprop="mainContentOfPage">
            <div class="container" >
                <div class="row justify-content-center" >
                    <div class="col-11 col-sm-10 col-md-10 col-lg-8 col-xl-8 col-xxl-8 px-0" itemprop="text">
                        <header id="header" class="row pt-5" itemprop="header">
                            <div class="col-12 py-4 text-center text-md-start" itemprop="name">
                                @if( Request::url() == route('home') )
                                <h1 id="sitename" itemprop="headline">
                                    <a href="{{ route('home') }}" itemprop="url">
                                        {{ env('APP_NAME') }}
                                    </a> <i data-eva="github"></i>
                                </h1>
                                @else
                                <div id="sitename" itemprop="headline">
                                    <a href="{{ route('home') }}" itemprop="url">
                                        {{ env('APP_NAME') }}
                                    </a>
                                </div>
                                @endif
                            </div>
                        </header>
                        <article id="content" class="row" itemprop="articleBody">
                            <div class="col-12 pt-5" itemprop="text">
                                @yield('content')
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </main>
        <footer id="footer" class="container mt-5 pt-5 border-top" itemprop="footer">
            @include('partials.footer')
        </footer>
        <script type="text/javascript" src="{{ asset('assets/vendor/Jquery/jquery-3.7.1.min.js') }}" ></script>
        <script type="text/javascript" src="{{ asset('assets/vendor/Bootstrap/bootstrap.bundle.min.js') }}" ></script>
        @stack('footer_scripts')
    </body>
</html>
