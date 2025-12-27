<x-layouts.main-layout-component title="Profile - Edit" description="Edit the user profile" >
    <section class="row" >

        <header class="col-12" >
            <x-page-title-component title="Profile - Edit" />
        </header>

        <aside class="col-3" >
            <x-profile.side-menu-component />
        </aside>

        <article class="col-9" >
            <x-profile.profile-edit-form-component :user="$user" />
        </article>

    </section>
</x-layouts.main-layout-component>
