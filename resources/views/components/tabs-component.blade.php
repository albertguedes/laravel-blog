<div>
    <ul class="nav nav-tabs">
        @foreach( $routes as $route )
        <li class="nav-item">
            @if( $route['url'] == Request::url() )
            <a class="nav-link active" aria-current="page" href="{{ $route['url'] }}" >{{ $route['name'] }}</a>
            @else
            <a class="nav-link" href="{{ $route['url'] }}" >{{ $route['name'] }}</a>
            @endif
        </li>
        @endforeach
    </ul>
</div>
