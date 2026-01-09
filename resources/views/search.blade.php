<x-layouts.main-layout-component title="Search" description="Search posts from terms" >
    <section class="row" >
        <header class="col-12">
            <x-page-title-component title="Search" />
        </header>
        <section class="mb-4 col-12" >
            <form class="d-flex w-100" role="search" method="GET" action="{{ route('search') }}" >
                @csrf
                <div class="mb-3 input-group">
                    <input type="search" class="form-control" id="search" name="q" placeholder="Type a term to search" value="@if($query) {{ $query }} @endif" aria-label="Search">
                    <button type="submit" class="input-group-button btn btn-dark" >
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>
        </section>

        @if($results->count() > 0)
        <section class="col-12" >
            <h3 class="mb-4 text-capitalize" >Results for <em>'{{ $query }}'</em> :</h3>
        </section>

        <article class="col-12" >
            <ul class="list-unstyled h6">
                @foreach ($results as $post)
                <li class="list-item pb-3">
                    <a href="{{ route('post', compact('post')) }}" property="url" href="{{ route('post', compact('post')) }}" class="list-link text-decoration-none">
                        <h2 class="mb-1 h6">{{ $post->title }}</h2>
                        <p class="text-black-50">{{ Str::limit(strip_tags($post->content), 150) }}</p>
                    </a>
                </li>
                @endforeach
            </ul>
        </article>

        <section class="pt-5 col-12 d-flex justify-content-center">
            {!! $results->links() !!}
        </section>
        @endif

    </section>
</x-layouts.main-layout-component>
