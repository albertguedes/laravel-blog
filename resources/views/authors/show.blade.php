<x-layouts.main title="{!! ucwords($author->profile->name) !!}'s Blog" description="Posts by {!! $author->profile->name !!}" >
    <section class="row" vocab="https://schema.org/" typeof="CollectionPage">

        <header class="col-12" >
            <x-common.page-title title="{{ $author->profile->name }}'s Blog" />
        </header>

        @if (count($posts) > 0)

            @foreach( $posts as $post )
            <article class="col-12" property="mainEntity" typeof="BlogPosting">
                <x-posts.post-details :post="$post" />
            </article>
            @endforeach

            <div class="col-12 d-flex justify-content-center">
                <x-common.bootstrap-pagination :paginator="$posts" />
            </div>

        @else
        <div class="col-12" >
            <p>No posts.</p>
        </div>
        @endif

    </section>
</x-layouts.main>
