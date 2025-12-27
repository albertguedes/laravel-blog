<x-layouts.main-layout-component title="{!! ucwords($author->profile->name) !!}'s Blog" description="Posts by {!! $author->profile->name !!}" >
    <section class="row" vocab="https://schema.org/" typeof="CollectionPage">

        <header class="col-12" >
            <x-page-title-component title="{{ $author->profile->name }}'s Blog" />
        </header>

        @if (count($posts) > 0)

            @foreach( $posts as $post )
            <article class="col-12" property="mainEntity" typeof="BlogPosting">
                <x-post-details-component :post="$post" />
            </article>
            @endforeach

            <div class="col-12 d-flex justify-content-center">
                {!! $posts->links() !!}
            </div>

        @else
        <div class="col-12" >
            <p>No posts.</p>
        </div>
        @endif

    </section>
</x-layout.main-layout-component>
