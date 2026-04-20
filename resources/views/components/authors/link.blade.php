<em>
    <a href="{{ $route }}" >
        @if($is_active === 1)
        {{ $name }}
        @else
        <span class="text-decoration-line-through" >{{ $name }}</span>
        @endif
    </a>
</em>
