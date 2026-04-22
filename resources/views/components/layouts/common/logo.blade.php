<div class="py-4 text-start" itemprop="logo">
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
