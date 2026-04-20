<div class="list-group h6">
    @foreach ($items as $item)
    <a class="list-group-item list-group-item-action {{ $item['active'] ? 'active' : '' }}" href="{{ route($item['route']) }}">
        <i class="{{ $item['icon'] }}"></i> {{ $item['label'] }}
    </a>
    @if (isset($item['subitems']))
        @foreach ($item['subitems'] as $subitem)
        <a class="list-group-item list-group-item-action ps-4 {{ $subitem['active'] ? 'active' : '' }}" href="{{ route($subitem['route']) }}">
            <i class="{{ $subitem['icon'] }}"></i> {{ $subitem['label'] }}
        </a>
        @endforeach
    @endif
    @endforeach
</div>
