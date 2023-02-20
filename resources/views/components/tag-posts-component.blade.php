<div>
    <ul>
        @foreach( $tag->posts as $post )
        <li class="pb-3" >
            <h2 class="text-capitalize" ><a href="{{ route('post',compact('post')) }}" >{{ $post->title }}</a></h2>
            <h6 class="text-secondary" >by <em>{{ $post->author->name }}</em></h6>
        </li>
        @endforeach
    </ul>
</div>
