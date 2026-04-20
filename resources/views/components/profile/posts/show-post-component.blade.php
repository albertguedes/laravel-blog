<div class="row card {{ $post->published ??  'disabled' }}" id="post-{{ $post->id }}" >

    <header class="col-12 card-header border-bottom-0" >

        <h6 class="mb-3" >
            <span class="badge bg-{{ $post->published ? 'success' : 'danger' }}" >{{ $post->published ? 'Published' : 'Unpublished' }}</span>
        </h6>

        <h2 class="mb-2 text-capitalize" >
            {{ $post->title }}
        </h2>

        <h6 class="mb-3 text-black-50" >
            <i class="fa fa-sync" ></i> {{ $post->updated_at->format("Y M d h:i:s") }} - <i class="fas fa-calendar-alt"></i> {{ $post->created_at->format("Y M d h:i:s") }}
        </h6>

    </header>

    <article class="col-12 card-body" >

        <div class="mb-5 card-text h6" >
            <h6 class="fw-bold" >
                <i class="fas fa-link"></i> Slug
            </h6>
            <div class="fst-italic" >
                <a href="{{ route('post', compact('post')) }}" >{{ $post->slug }}</a>
            </div>
        </div>

        <div class="mb-5 card-text h6" >
            <h6 class="fw-bold" >
                <i class="fas fa-align-left"></i> Description
            </h6>
            <div class="fst-italic" >
                {{ $post->description }}
            </div>
        </div>

        <div class="mb-5 card-text h5" >
            <h6 class="fw-bold" >
                <i class="fas fa-file-alt"></i> Content
            </h6>
            {{ $post->content }}
        </div>

    </article>

    <footer class="col-12 card-footer border-top-0" >
        <div class="row h6" >

            @if( $post->category )
            <div class="py-3 col-6" >
                <a href="{{ route('category',['category'=>$post->category]) }}" >
                    <i class="fas fa-sitemap"></i> {{ $post->category->title }}
                </a>
            </div>
            @endif

            @if( $post->tags()->count() )
            <div class="py-3 col-6" >
                @foreach ($post->tags as $tag)
                <a class="me-2 d-inline-flex align-items-center" href="{{ route('tag', compact('tag')) }}">
                    <i class="fas fa-tag"></i><span class="px-1 hidden-char" >_</span>{{ $tag->title }}
                </a>
                @endforeach
            </div>
            @endif

        </div>

    </footer>

</div>
