<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" vocab="https://schema.org/" typeof="WebSite">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" >
        <meta name="description" content="{{ isset($description) ? $description : '' }}" >
        <meta name="csrf-token" content="{{ csrf_token() }}" >
        <title>{{ isset($title) ? $title . ' | ' : '' }}{{ config('app.name') }}</title>
        <x-layouts.common.json-ld-schema type="WebSite" />
        <script type="text/javascript" src="{{ asset('assets/vendor/FontAwesome/f761473b22.js') }}" ></script>
        <link type="text/css" href="{{ asset('assets/vendor/Bootstrap/bootstrap.min.css') }}" rel="stylesheet" >
        <link type="text/css" href="{{ asset('assets/css/fonts.css') }}" rel="stylesheet" >
        <link type="text/css" href="{{ asset('assets/css/style.css') }}" rel="stylesheet" >
        <link type="text/css" href="{{ asset('assets/css/footerbottom.css') }}" rel="stylesheet" >
        {{ isset($styles) ? $styles : '' }}
        <link type="image/x-icon" rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" >
        {{ isset($scripts) ? $scripts : '' }}
    </head>
    <body class="d-flex flex-column h-100" itemscope itemtype="http://schema.org/WebSite">

        @auth
        <div class="container" >
            <div class="row justify-content-center" >
                <div class="px-0 col-11 col-sm-10 col-md-10 col-lg-8 col-xl-8 col-xxl-8" itemprop="text">
                    <x-layouts.common.navbar />
                </div>
            </div>
        </div>
        @endauth

        <main id="main" class="flex-shrink-0" itemprop="mainContentOfPage">
            <div class="container" >
                <div class="row justify-content-center" >
                    <div class="px-0 col-11 col-sm-10 col-md-10 col-lg-8 col-xl-8 col-xxl-8" itemprop="text">
                        <header id="header" class="row" itemprop="header">
                            <div class="py-5 col-12" >
                                <x-layouts.common.logo />
                            </div>
                        </header>
                        <article id="content" class="row" itemprop="articleBody">
                            <div class="text-center col-12">
                                <x-common.flash-messages />
                            </div>
                            <div class="col-12" itemprop="text">
                                {{ $slot }}
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </main>
        <footer id="footer" class="container pt-5 mt-5 border-top" itemprop="footer">
            <div class="row justify-content-center align-items-center">
                <div class="px-0 col-11 col-sm-10 col-md-10 col-lg-8 col-xl-8 col-xxl-8" itemprop="text">
                    <x-layouts.main.footer />
                </div>
            </div>
        </footer>
        <script type="text/javascript" src="{{ asset('assets/vendor/Jquery/jquery-3.7.1.min.js') }}" ></script>
        <script type="text/javascript" src="{{ asset('assets/vendor/Bootstrap/bootstrap.bundle.min.js') }}" ></script>
        <script type="text/javascript" src="{{ asset('assets/js/helpers/validation.js') }}" ></script>
        <script type="text/javascript" src="{{ asset('assets/js/helpers/dom.js') }}" ></script>
        <script type="text/javascript" src="{{ asset('assets/js/helpers/masks.js') }}" ></script>
        <script type="text/javascript" src="{{ asset('assets/js/helpers/strings.js') }}" ></script>
        <script type="text/javascript" src="{{ asset('assets/js/helpers/time.js') }}" ></script>
        <script type="text/javascript" src="{{ asset('assets/js/script.js') }}" ></script>
        {{ isset($footer_scripts) ? $footer_scripts : '' }}
    </body>
</html>
