<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" vocab="https://schema.org/" typeof="WebSite">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" >
        <meta name="description" content="{{ $description }}" >
        <title>@if($title) {{ $title }} | @endif {{ env('APP_NAME') }}</title>
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
        <script type="text/javascript" src="{{ asset('assets/vendor/FontAwesome/f761473b22.js') }}" ></script>
        <link type="text/css" href="{{ asset('assets/vendor/Bootstrap/bootstrap.min.css') }}" rel="stylesheet" >
        <link type="text/css" href="{{ asset('assets/css/fonts.css') }}" rel="stylesheet" >
        <link type="text/css" href="{{ asset('assets/css/style.css') }}" rel="stylesheet" >
        <link type="text/css" href="{{ asset('assets/css/footerbottom.css') }}" rel="stylesheet" >
        @if($styles){{ $styles }}@endif
        <link type="image/x-icon" rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" >
        @if($scripts){{ $scripts }}@endif
    </head>
    <body class="d-flex flex-column h-100" itemscope itemtype="http://schema.org/WebSite">
        <main id="main" class="flex-shrink-0" itemprop="mainContentOfPage">
            <div class="container" >
                <div class="row justify-content-center" >
                    <div class="col-11 col-sm-10 col-md-10 col-lg-8 col-xl-8 col-xxl-8 px-0" itemprop="text">
                        <header id="header" class="row py-5" itemprop="header">
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
                            <div class="col-12 text-center">
                                <x-flash-messages-component />
                            </div>
                            <div class="col-12" itemprop="text">
                                {{ $slot }}
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
        <script type="text/javascript" src="{{ asset('assets/js/helpers/validation.js') }}" ></script>
        <script type="text/javascript" src="{{ asset('assets/js/helpers/dom.js') }}" ></script>
        <script type="text/javascript" src="{{ asset('assets/js/helpers/masks.js') }}" ></script>
        <script type="text/javascript" src="{{ asset('assets/js/helpers/strings.js') }}" ></script>
        <script type="text/javascript" src="{{ asset('assets/js/helpers/time.js') }}" ></script>
        <script type="text/javascript" src="{{ asset('assets/js/script.js') }}" ></script>
        @if($footer_scripts){{ $footer_scripts }}@endif
    </body>
</html>

