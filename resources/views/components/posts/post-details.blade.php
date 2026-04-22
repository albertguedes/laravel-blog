<article class="mb-5 col-12" id="post-{{ $post->id }}">

    <header class="mb-3">
        <h3 class="mb-1">
            <a href="{{ route('post', $post) }}" class="text-decoration-none">
                {{ $post->title }}
            </a>
        </h3>
        <small class="text-muted h6">
            <i class="fa fa-calendar-alt"></i> {{ $post->created_at->format('Y M d') }}
        </small>
    </header>

    <p class="mb-2 h5">
        {{ Str::limit(strip_tags($post->content), 200) }} <a href="{{ route('post', $post) }}" class="text-decoration-none">read more</a>
    </p>

</article>
