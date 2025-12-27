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
                    <div class="px-0 col-11 col-sm-10 col-md-10 col-lg-8 col-xl-8 col-xxl-8" itemprop="text">
                        <header id="header" class="py-5 row" itemprop="header">
                            <div class="py-4 text-center col-12 text-md-start" itemprop="name">
                                <div id="sitename" class="text-center" itemprop="headline">
                                    <a href="{{ route('home') }}" itemprop="url">
                                        {{ env('APP_NAME') }}
                                    </a>
                                </div>
                            </div>
                        </header>
                        <article id="content" class="row" itemprop="articleBody">
                            <div class="text-center col-12">
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
        <footer id="footer" class="container py-3 mt-5 text-center" itemprop="footer">
            Laravel Blog {{ date('Y') }} - Free & Open Source
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
