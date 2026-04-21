<article class="col-12 mb-4" id="post-{{ $post->id }}">

    <header class="mb-3">
        <h3 class="mb-1">
            <a href="{{ route('post', $post) }}" class="text-decoration-none">
                {{ $post->title }}
            </a>
        </h3>
        <small class="text-muted">
            <i class="fa fa-calendar-alt"></i> {{ $post->created_at->format('Y M d') }}
            @if($post->category)
                <span class="mx-2">|</span>
                <i class="fa fa-folder"></i>
                <a href="{{ route('category', $post->category) }}" class="text-decoration-none">
                    {{ $post->category->title }}
                </a>
            @endif
        </small>
    </header>

    <p class="mb-2">
        {{ Str::limit(strip_tags($post->content), 200) }}
    </p>

    @if($post->tags->count() > 0)
        <footer class="mt-2">
            @foreach($post->tags as $tag)
                <a href="{{ route('tag', $tag) }}"
                   class="badge bg-secondary text-decoration-none me-1">
                    <i class="fa fa-tag"></i> {{ $tag->title }}
                </a>
            @endforeach
        </footer>
    @endif

</article>