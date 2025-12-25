<ul class="list-unstyled" >
    @if($posts->count() > 0)
        @foreach ($posts as $post)
        <div class="col-12" property="mainEntity" typeof="BlogPosting">
            <x-post-details-component :post="$post" />
        </div>
        @endforeach
        <div class="col-12 d-flex justify-content-center">
            {!! $posts->links() !!}
        </div>
    @else
        <div class="col-12" >
            <p>No posts.</p>
        </div>
    @endif
</ul>
