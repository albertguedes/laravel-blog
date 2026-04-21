<x-layouts.main title="Blog Authors" description="List of all blog authors" >
    <section class="row" >

        <header class="col-12">
            <x-common.page-title title="Blog Authors" />
        </header>

        @if ($authors->count() > 0)
        <article class="col-12" >
            <div class="row" >
                @foreach ($authors as $author)
                <div class="col-4 d-flex" >
                    <x-common.author-card :author="$author" />
                </div>
                @endforeach
            </div>
        </article>
        <footer class="col-12 d-flex justify-content-center pt-5">
            <x-common.bootstrap-pagination :paginator="$authors" />
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

</x-layouts.main>

