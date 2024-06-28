@unless($breadcrumbs->isEmpty())
<nav aria-label="breadcrumb" class="d-flex flex-column align-items-center justify-content-center">
    <ol class="breadcrumb">
    @foreach ($breadcrumbs as $breadcrumb)
        @if ($loop->first)
        <li class="breadcrumb-item d-flex align-items-center justify-content-center">
            @if($loop->first == $loop->last)
            <span>&nbsp;</span>
            @else
            <a href="{{ $breadcrumb->url }}">
                <i class="fas fa-home"></i>
            </a>
            @endif
        </li>
        @elseif($loop->last)
        <li class="breadcrumb-item d-flex align-items-center justify-content-center">
            {{ $breadcrumb->title }}
        </li>
        @else
        <li class="breadcrumb-item d-flex align-items-center justify-content-center">
            @if($breadcrumb->url)
            <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
            @else
            {{ $breadcrumb->title }}
            @endif
        </li>
        @endif
    @endforeach
    </ol>
</nav>
@endunless
