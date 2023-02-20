<div>
    @foreach ( $tags as $tag )
    @php
        $n_posts = $tag->posts->count();
        $font_size = ( 2*$n_posts + 18 )."px";
    @endphp
    @if($n_posts>0)
    <a class='pe-3 text-lowercase' style='font-size: {{$font_size}};' href="{{ route('tag',compact('tag')) }}" >
        {{ $tag->title  }} ({{ $n_posts }})
    </a>
    @endif
    @endforeach
</div>
