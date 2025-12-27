<x-layouts.main-layout-component title="Categories" description="List of all categories" >
    <section class="row" >

        <header class="col-12" >
            <x-page-title-component title="Categories" icon="sitemap" />
        </header>

        <article class="col-12" >
            <x-categories.tree-component />
        </article>

    </section>

    <x-slot:footer_scripts>
        <script type="text/javascript" src="{{ asset('assets/js/pages/categories/index.js') }}" ></script>
    </x-slot:footer_scripts>
</x-layouts.main-layout-component>
