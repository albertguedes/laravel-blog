<div class="card @if(!$isActive) author-inactive @endif" >

    <header class="card-header border-bottom-0" >

        <h2 class="card-title text-capitalize author-name" >
            <a href="{{ route('author',compact('author')) }}" >
                {{ $author->profile->name ?? 'Unnamed Author' }}
            </a>
        </h2>

        <h6 class="card-subtitle m-0 p-0" >
            <i class="fas fa-calendar-alt"></i> {{ $author->created_at->format("Y M d") }}
            @if(!$isActive)
            <span class="badge bg-secondary ms-1">Inactive</span>
            @endif
        </h6>

    </header>

    <article class="card-body" >
        <div class="card-text author-about py-2 mb-0 h6" >
            {{ $author->profile->about ?? '' }}
        </div>
    </article>

    <footer class="card-footer border-top-0 text-center" >
        @if($posts_count > 0)
        <a class="text-danger h6" href="{{ route('author',compact('author')) }}" >
            {{ $posts_count }} posts - see more
        </a>
        @else
        <span class="h6" >No posts yet</span>
        @endif
    </footer>

</div>
