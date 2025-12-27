<x-layouts.main-layout-component title="Archive" description="Posts archive" >
    <section class="row" >

        <header class="col-12">
            <x-page-title-component title="Archive" icon="archive" />
        </header>

        <article class="col-12" >
            <x-posts.archive-component :year="$year" :month="$month" :day="$day" />
        </article>

    </section>
</x-layouts.main-layout-component>
