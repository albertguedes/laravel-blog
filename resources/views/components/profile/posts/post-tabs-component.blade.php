<div class="nav nav-tabs mb-5 h6" id="PostTab" role="tablist">
    @foreach ($tabs as $key => $tab)
    <a class="nav-item nav-link @if($tab['active']) active @endif"
        id="tab-{{ $key }}"
        data-toggle="tab"
        href="{{ $tab['route'] }}"
        role="tab"
        aria-controls="tab-{{ $key }}"
        aria-selected="@if($tab['active']) true @endif"
    >
        <i class="{{ $tab['icon'] }}"></i> {{ $tab['label'] }}
    </a>
    @endforeach
</div>
