<x-layouts.main-layout-component title="Blog Authors" description="List of all blog authors" >
    <section class="row" >

        <header class="col-12">
            <x-page-title-component title="Blog Authors" />
        </header>

        @if ($authors->count() > 0)
        <article class="col-12" >
            <div class="row" >
                @foreach ($authors as $author)
                <div class="col-4" >
                    <x-authors.author-card-component :author="$author" />
                </div>
                @endforeach
            </div>
        </article>
        <footer class="col-12 d-flex justify-content-center pt-5">
            {!! $authors->links() !!}
        </footer>
        @else
        <article class="col-12" >
            <p>No active authors.</p>
        </article>
        @endif

    </section>

    <x-slot:footer_scripts>
        <script type="text/javascript" src="{{ asset('assets/js/pages/authors/index.js') }}" ></script>
    </x-slot:footer_scripts>

</x-layout.main-layout-component>

