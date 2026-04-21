<x-layouts.main title="Home" description="A simple blog made in laravel" >
    <section class="row" vocab="http://schema.org/" typeof="CreativeWork">

        @if (count($posts) > 0)

            @foreach ($posts as $post)
            <div class="col-12" property="mainEntity" typeof="BlogPosting">
                <x-posts.post-details :post="$post" />
            </div>
            @endforeach

            <div class="pt-5 col-12 d-flex justify-content-center">
                <x-common.bootstrap-pagination :paginator="$posts" />
            </div>

        @else
        <div class="col-12" >
            <p>No posts.</p>
        </div>
        @endif

    </section>
</x-layouts.main>
