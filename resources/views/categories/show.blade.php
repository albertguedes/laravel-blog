<x-layouts.main title="{{ strtoupper($category->title) }}" description="{{ $category->description }}" >
    <section class="row" vocab="http://schema.org/" typeof="BlogPosting">

        <header class="col-12" property="headline name">
            <x-common.page-title :title="$category->title" icon="sitemap" />
        </header>

        <section class="col-12 mb-5 h6 fst-italic" property="description" >
            {{ $category->description }}
        </section>

        <article class="col-12" property="mainEntityOfPage">
            <x-category-posts :category="$category" />
        </article>

    </section>
</x-layouts.main>
