<x-layouts.main title="Archive" description="Posts archive" >
    <section class="row" >

        <header class="col-12">
            <x-common.page-title title="Archive" icon="archive" />
        </header>

        <article class="col-12" >
            <x-archive.archive :year="$year" :month="$month" :day="$day" />
        </article>

    </section>
</x-layouts.main>
