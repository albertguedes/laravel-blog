<h3 class="text-capitalize text-center py-3 mb-3 h1" >
    @foreach($items as $item)
        @if($item['active'])
        <a href="{{ $item['route'] }}" class="text-secondary archive-title-link" >
            @if($item['icon'])<i class="{{ $item['icon'] }}"></i>@endif
            <span class="pe-2" >{{ $item['label'] }}</span>
        </a>
        @endif
    @endforeach
</h3>
