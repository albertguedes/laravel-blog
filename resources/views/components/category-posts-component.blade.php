<div>
    <ul>
        @foreach( $posts as $post )
        <li class="pb-3" >
            <h2 class="text-capitalize" ><a href="{{ $post['route'] }}" >{{ $post['title'] }}</a></h2>
            <h6 class="text-secondary" >by <em>{{ $post['author'] }}</em></h6>
        </li>
        @endforeach
    </ul>
</div>
