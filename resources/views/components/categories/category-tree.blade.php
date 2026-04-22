<ul id='category-tree' class='list-unstyled' >

    @php $level = 0; @endphp

    @foreach ($tree as $i => $categoria)

        @if($categoria['level'] > $level)
        <li><ul id='children-{{ $tree[$i-1]['id'] }}' class="collapse" >
        @endif

        @if($categoria['level'] < $level)
            @php $diff = $level - $categoria['level']; @endphp
            @for($j = 0; $j < $diff; $j++)
                </ul></li>
            @endfor
        @endif

        <li class='text-decoration-none mb-2' >
            @if(isset($tree[$i + 1]) && $tree[$i + 1]['level'] > $categoria['level'])
            <a class='collapse-link fw-bold' data-bs-toggle='collapse' data-bs-target='#children-{{ $categoria['id'] }}' href='#' >
                <span class='collapse-icon'>
                    <i class="fa fa-folder-plus"></i>
                </span>
                {{ $categoria['title'] }} ({{ $categoria['count_posts'] }})
            </a>
            @else
            <i class="fa fa-folder-open"></i>
            <a href="{{ route('category', ['category' => $categoria['slug']]) }}" >
                {{ $categoria['title'] }} ({{ $categoria['count_posts'] }})
            </a>
            @endif
        </li>

        @php $level = $categoria['level'] @endphp

    @endforeach

    @for($j = 0; $j < $level; $j++) </ul></li> @endfor
</ul>
