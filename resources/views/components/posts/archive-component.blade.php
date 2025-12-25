<div class="row" >

    @if(!$current_year && !$current_month && !$current_day)
        @if(count($archive) > 0 )
            @foreach($archive as $year => $months)
            <div class="col-3 text-center" >
                <a class="text-secondary" href="{{ route('archive', compact('year')) }}" >
                    <i class="fa fa-folder archive-folder-icon"></i>
                    <br>
                    {{ $year }} ({{ count($months) }})
                </a>
            </div>
            @endforeach
        @else
        <div class="col-12" >
            <p>No posts.</p>
        </div>
        @endif
    @endif

    @if($current_year && !$current_month && !$current_day)
        <div class="col-12" >
            <x-archive.archive-title-component :year="$current_year" />
        </div>

        @if(isset($archive[$current_year]) && count($archive[$current_year]) > 0 )

            <div class="col-3 text-center" >
                <a class="text-secondary" href="{{ route('archive') }}" >
                    <i class="fa fa-folder archive-folder-icon"></i>
                    <br>
                    ..
                </a>
            </div>

            @foreach($archive[$current_year] as $month => $days)
            <div class="col-3 text-center" >
                <a class="text-secondary" href="{{ route('archive', ['year' => $current_year, 'month' => $month]) }}" >
                    <i class="fa fa-folder archive-folder-icon"></i>
                    <br>
                    {{ \Carbon\Carbon::create(1,$month,1)->format('M') }} ({{ count($days) }})
                </a>
            </div>
            @endforeach
        @else
        <div class="col-12" >
            <p>No posts.</p>
        </div>
        @endif
    @endif

    @if($current_year && $current_month && !$current_day)
        <div class="col-12" >
            <x-archive.archive-title-component :year="$current_year" :month="$current_month" />
        </div>
        @if(isset($archive[$current_year][$current_month]) && count($archive[$current_year][$current_month]) > 0 )

            <div class="col-3 text-center" >
                <a class="text-secondary" href="{{ route('archive', ['year' => $current_year ]) }}" >
                    <i class="fa fa-folder archive-folder-icon"></i>
                    <br>
                    ..
                </a>
            </div>

            @foreach($archive[$current_year][$current_month] as $day => $count)
            <div class="col-3 text-center" >
                <a class="text-secondary" href="{{ route('archive', [ 'year' => $current_year, 'month' => $current_month, 'day' => $day ]) }}" >
                    <i class="fa fa-folder archive-folder-icon"></i>
                    <br>
                    {{ $day }} ({{ $archive[$current_year][$current_month][$day] }})
                </a>
            </div>
            @endforeach
        @else
        <div class="col-12" >
            <p>No posts.</p>
        </div>
        @endif
    @endif

    @if($current_year && $current_month && $current_day)
        <div class="col-12" >
            <x-archive.archive-title-component :year="$current_year" :month="$current_month" :day="$current_day" />
        </div>
        @if(isset($archive[$current_year][$current_month][$current_day]) && count($paginate) > 0 )
            @foreach($paginate as $post)
            <div class="col-12" >
                <x-post-details-component :post="$post" />
            </div>
            @endforeach
            <div class="col-12 d-flex justify-content-center">
                {!! $paginate->links() !!}
            </div>
        @else
        <div class="col-12" >
            <p>No posts.</p>
        </div>
        @endif
    @endif

</div>
