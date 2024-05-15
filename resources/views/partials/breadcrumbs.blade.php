@unless($breadcrumbs->isEmpty())
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    @foreach ($breadcrumbs as $breadcrumb)
        @if ($breadcrumb->url && !$loop->last)
        <li class="breadcrumb-item pt-1" >
            <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
        </li>
        @else
        <li class="breadcrumb-item pt-1 active" aria-current="page" >
            {{ $breadcrumb->title }}
        </li>
        @endif
    @endforeach
    </ol>
</nav>
@endunless
