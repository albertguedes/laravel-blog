<x-layouts.main title="Profile" description="User profile" >
    <section class="row" >

        <header class="col-12" >
            <x-common.page-title title="Profile" />
        </header>

        <aside class="col-3" >
            <x-side-menu />
        </aside>

        <article class="col-9" >
            <x-user-profile :user="$user" />
        </article>

    </section>
</x-layouts.main>
