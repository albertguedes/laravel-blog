<x-layouts.main title="Profile - Edit" description="Edit the user profile" >
    <section class="row" >

        <header class="col-12" >
            <x-common.page-title title="Profile - Edit" />
        </header>

        <aside class="col-3" >
            <x-common.side-menu />
        </aside>

        <article class="col-9" >
            <x-common.profile-edit-form :user="$user" />
        </article>

    </section>
</x-layouts.main>
