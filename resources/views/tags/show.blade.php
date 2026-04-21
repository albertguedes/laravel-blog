<x-layouts.main title="{{ strtoupper($tag->title) }}" description="{{ $tag->description }}" >
    <section class="row" >

        <header class="col-12" >
            <x-common.page-title :title="$tag->title" icon="tag" />
        </header>

        <section class="col-12 mb-5 h6 fst-italic" >
            {{ $tag->description }}
        </section>

        <article class="col-12" >
            <x-tag-posts :tag="$tag" />
        </article>

    </section>
</x-layouts.main>
