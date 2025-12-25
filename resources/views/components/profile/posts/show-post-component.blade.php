<div class="row card {{ $post->published ??  'disabled' }}" id="post-{{ $post->id }}" >

    <header class="col-12 card-header border-bottom-0" >

        <h6 class="mb-3" >
            <span class="badge bg-{{ $post->published ? 'success' : 'danger' }}" >{{ $post->published ? 'Published' : 'Unpublished' }}</span>
        </h6>

        <h2 class="text-capitalize mb-2" >
            {{ $post->title }}
        </h2>

        <h6 class="text-black-50 mb-3" >
            <i class="fa fa-sync" ></i> {{ $post->updated_at->format("Y M d h:i:s") }} - <i class="fas fa-calendar-alt"></i> {{ $post->created_at->format("Y M d h:i:s") }}
        </h6>

    </header>

    <article class="col-12 card-body" >

        <div class="card-text h6 mb-5" >
            <h6 class="fw-bold" >
                <i class="fas fa-link"></i> Slug
            </h6>
            <div class="fst-italic" >
                {{ $post->slug }}
            </div>
        </div>

        <div class="card-text h6 mb-5" >
            <h6 class="fw-bold" >
                <i class="fas fa-align-left"></i> Description
            </h6>
            <div class="fst-italic" >
                {{ $post->description }}
            </div>
        </div>

        <div class="card-text h5 mb-5" >
            <h6 class="fw-bold" >
                <i class="fas fa-file-alt"></i> Content
            </h6>
            {{ $post->content }}
        </div>

    </article>

    <footer class="col-12 card-footer border-top-0" >
        <div class="row h6" >

            @if( $post->category )
            <div class="col-6 py-3" >
                <a href="{{ route('category',['category'=>$post->category]) }}" >
                    <i class="fas fa-sitemap"></i> {{ $post->category->title }}
                </a>
            </div>
            @endif

            @if( $post->tags()->count() )
            <div class="col-6 py-3" >
                @foreach ($post->tags as $tag)
                <a class="me-2 d-inline-flex align-items-center" href="{{ route('tag', compact('tag')) }}">
                    <i class="fas fa-tag"></i><span class="hidden-char px-1" >_</span>{{ $tag->title }}
                </a>
                @endforeach
            </div>
            @endif

        </div>

    </footer>

</div>
