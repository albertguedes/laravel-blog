<x-layouts.main title="Tags" description="List of all tags" >
    <section class="row" vocab="https://schema.org/" typeof="CollectionPage">

        <header class="col-12" property="name">
            <x-common.page-title title="Tags" icon="tag" />
        </header>

        <article class="col-12" property="mainEntity" typeof="ItemList">
            <x-tags.tag-cloud :tags="$tags" />
        </article>

    </section>
</x-layouts.main>
