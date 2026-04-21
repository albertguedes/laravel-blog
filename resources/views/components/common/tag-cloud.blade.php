<div class="text-center" >
    @if(count($tags) > 0)
        @foreach($tags as $tag)
            @if($tag['n_posts'] > 0)
                <a class="pe-4 text-lowercase" {{ $tag['font_size'] }} href="{{ route('tag', ['tag' => $tag['slug']]) }}">
                    <span style="white-space: nowrap;">
                        {{ $tag['title'] }}<span class="hidden-char">_</span>({{ $tag['n_posts'] }})
                    </span>
                </a>
            @endif
        @endforeach
    @else
    <p>No Tags</p>
    @endif
</div>
