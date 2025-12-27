<x-layouts.main-layout-component title="{{ strtoupper($post->title) }}" description="{!! $post->description !!}">
    <section class="row" >

        <header class="col-12" >

            <x-page-title-component :title="$post->title" />

            <h6 class="text-black-50" >
                <i class="fas fa-calendar-alt"></i> {{ $post->created_at->format("Y M d") }}
                by <x-authors.link :author-id="$post->author->id" />
            </h6>

        </header>

        <article class="py-5 col-12" >
            {{ $post->content }}
        </article>

        <footer class="col-12" >
            <div class="row h6" >

                @if ($post->category && $post->category->is_active)
                <div class="py-3 col-6" >
                    <a href="{{ route('category',['category'=>$post->category]) }}" ><i class="fas fa-sitemap"></i> {{ $post->category->title }}</a>
                </div>
                @endif

                @if( $post->tags()->count() )
                <div class="py-3 col-6" >
                    @foreach ($post->tags as $tag)
                        @if($tag->is_active)
                        <a class="me-2 d-inline-flex align-items-center" href="{{ route('tag', compact('tag')) }}">
                            <i class="fas fa-tag me-1"></i>{{ $tag->title }}
                        </a>
                        @endif
                    @endforeach
                </div>
                @endif

            </div>
        </footer>

    </section>
</x-layouts.main-layout-component>
