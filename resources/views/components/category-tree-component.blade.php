<div>
    <ul id='category-tree' class='list-unstyled' >

        @php
            $level = 0;
        @endphp

        @foreach( $tree as $i => $categoria )

                @if($categoria['level'] > $level)
                    <ul id='children-{{ $tree[$i-1]['id'] }}' class="collapse" >
                @endif

                @if($categoria['level'] < $level)
                    @php $diff = $level - $categoria['level']; @endphp
                    @for($j = 0; $j < $diff; $j++)
                        </li></ul>
                    @endfor
                @endif

                <li class='text-decoration-none mb-2' >
                    @if(isset($tree[$i + 1]) && $tree[$i + 1]['level'] > $categoria['level'])
                    <a class='collapse-link pe-2 fw-bold' data-bs-toggle='collapse' data-bs-target='#children-{{ $categoria['id'] }}' href='#' >
                        [<span class='collapse-icon'>+</span>]
                    </a>
                    @else
                    &nbsp;-&nbsp;
                    @endif
                    <a href="{{ route('category', ['category' => $categoria['slug']]) }}" >
                        {{ $categoria['title'] }} ({{ $categoria['count_posts'] }})
                    </a>
                </li>

                @php $level = $categoria['level'] @endphp

        @endforeach

        @for($j = 0; $j < $level; $j++) </li></ul> @endfor

    </ul>
</div>
