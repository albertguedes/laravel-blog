<div class="card flex-fill mb-4 @if(!$isActive) author-inactive @endif" >

    <header class="card-header border-bottom-0 my-3 py-0 d-flex align-items-center" >
        <h2 class="card-title text-capitalize author-name m-0 p-0" >
            <a class="p-0 m-0" href="{{ route('author',compact('author')) }}" >
                {{ $author->profile->name ?? 'Unnamed Author' }}
            </a>
        </h2>
    </header>

    <article class="card-body mt-0 pt-0" >
        <div class="card-text author-about py-0 my-0 h6" >
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
