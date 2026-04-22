<ul class="nav nav-tabs h5">
    @foreach ($items as $item)
    <li class="nav-item">
        <a class="nav-link {{ $item['active'] ? 'active' : '' }}" href="{{ route($item['route']) }}">
            <i class="{{ $item['icon'] }}"></i> {{ $item['label'] }}
        </a>
    </li>
    @endforeach
</ul>
