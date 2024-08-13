<div>
    @if(count($latest_posts)>0)
        @foreach( $latest_posts as $post )
        <div class="col-12 pb-5" >
            <h2><a href="{{ route('post',['post'=>$post]) }}" >{{ $post->title }}</a></h2>
            <h6 class="text-black-50" ><i class="fas fa-calendar-alt"></i> {{ $post->created_at->format("Y M d") }} by
            <em>{{ ucwords($post->author->name) }}</em></h6>
            <div class="py-3" >
                {{ $post->description }}
                <p class="fs-5 pt-3" ><a class="text-danger" href="{{ route('post',['post'=>$post]) }}" >Read More &raquo;</a></p>
            </div>
        </div>
        @endforeach
        <div class="d-flex justify-content-center pt-5">
            {!! $latest_posts->links() !!}
        </div>
    @else
        <p>No posts.</p>
    @endif
</div>
