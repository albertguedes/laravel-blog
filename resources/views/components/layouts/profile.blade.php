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

        <x-layouts.common.navbar />

        <main id="main" class="flex-shrink-0" itemprop="mainContentOfPage">
            <div class="container" >
                <div class="row" >
                    <header id="header" class="col-12" itemprop="header">
                        <x-layouts.common.logo />
                    </header>
                    <article id="content" class="col-12" itemprop="articleBody">
                        <div class="row" >
                            <header class="col-12" >
                                <x-common.page-title title="{{ isset($title) ? $title : '' }}" />
                            </header>

                            <div class="text-center col-12">
                                <x-common.flash-messages />
                            </div>

                            <aside class="col-2" >
                                <x-layouts.profile.side-menu />
                            </aside>

                            <div class="col-10" >
                                {{ $slot }}
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </main>
        <footer id="footer" class="container py-5 mt-5 border-top" itemprop="footer">
            <p class="p-0 m-0 text-center h6" >
                <strong>{{ config('app.name') }}</strong> &copy; {{ date('Y') }}
                <em class="ms-4" ><i class="fas fa-code"></i> Free & Open Source</em>
            </p>
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
