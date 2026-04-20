<x-layouts.main-layout-component title="{{ strtoupper($tag->title) }}" description="{{ $tag->description }}" >
    <section class="row" >

        <header class="col-12" >
            <x-page-title-component :title="$tag->title" icon="tag" />
        </header>

        <section class="col-12 mb-5 h6 fst-italic" >
            {{ $tag->description }}
        </section>

        <article class="col-12" >
            <x-tags.posts-component :tag="$tag" />
        </article>

    </section>
</x-layouts.main-layout-component>
