@if (count($archive) > 0)
<div class="row" >
    @if ($year > 0)
        @if ($month > 0)
            @if ($day > 0)
                <div class="col-12">
                    <h1 class="text-center mb-4" >{{ Carbon\Carbon::create($year,$month,$day)->format('Y F j') }}</h1>
                </div>
                @foreach ( $archive[$year][$month] as $day => $posts)
                <div class="col-12" >
                    <ul id="archive-{{ $year }}-{{ $month }}-{{ $day }}" class="list ps-5" >
                        @foreach( $posts as $post )
                        <li class="pb-5" >
                            <h5><a href="{{ route('post', compact('post')) }}" >{{ $post->title }}</a></h5>
                            <h6 class="text-black-50" >by <em>{{ ucwords($post->author->name) }}</em></h6>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            @else
                <div class="col-12">
                    <h1 class="text-center mb-4" >{{ Carbon\Carbon::create($year,$month,$day)->format('Y F') }}</h1>
                </div>
                @foreach ( $archive[$year][$month] as $day => $posts)
                <div class="col-3 pb-4 text-center" >
                    <a class="text-secondary" href="{{ route('archive', [ 'year' => $year, 'month' => $month, 'day' => $day ]) }}" >
                        <i class="fas fa-folder" style="font-size: 100px" ></i>
                        <br>
                        <span class="fs-4" >{{ $day }} ({{ count($archive[$year][$month][$day]) }})</span>
                    </a>
                </div>
                @endforeach
            @endif

        @else

            <div class="col-12">
                <h1 class="text-center mb-4" >{{ $year }}</h1>
            </div>
            @foreach ( $archive[$year] as $month => $days)
            <div class="col-3 pb-4 text-center" >
                <a class="text-secondary" href="{{ route('archive', [ 'year' => $year, 'month' => $month ]) }}" >
                    <i class="fas fa-folder" style="font-size: 100px" ></i>
                    <br>
                    <span class="fs-4" >{{ Carbon\Carbon::create($year,$month,$day)->format('F') }} ({{ count($archive[$year][$month]) }})</span>
                </a>
            </div>
            @endforeach

        @endif
    @else
        @foreach ( $archive as $year => $months)
        <div class="col-3 pb-4 text-center" >
            <a class="text-secondary" href="{{ route('archive', [ 'year' => $year ]) }}" >
                <i class="fas fa-folder" style="font-size: 100px" ></i>
                <br>
                <span class="fs-4" >{{ $year }} ({{ count($archive[$year]) }})</span>
            </a>
        </div>
        @endforeach
    @endif
</div>
@else
<p>No posts.</p>
@endif
<!--
@if(count($archive)>0)
<ul class='list-unstyled' >
    @foreach( $archive as $year => $months )
    <li>

        <h2>
            <a href="#archive-{{ $year }}" role="button"
                data-bs-toggle="collapse"
                aria-expanded="false"
                aria-controls="archive-{{ $year }}" >
                {{ $year }}
            </a>
        </h2>

        <ul id="archive-{{ $year }}" class="list collapse ps-5" >
            @foreach( $months as $month => $days )
            <li>

                <h3>
                    <a href="#archive-{{ $year }}-{{ $month }}" role="button"
                        data-bs-toggle="collapse"
                        aria-expanded="false"
                        aria-controls="archive-{{ $year }}-{{ $month }}" >
                        {{ $month }}
                    </a>
                </h3>

                <ul id="archive-{{ $year }}-{{ $month }}" class="list collapse ps-5" >
                    @foreach( $days as $day => $posts )
                    <li>
                        <h4>
                            <a href="#archive-{{ $year }}-{{ $month }}-{{ $day }}" role="button"
                                data-bs-toggle="collapse"
                                aria-expanded="false"
                                aria-controls="archive-{{ $year }}-{{ $month }}-{{ $day }}" >
                                {{ $day }}
                            </a>
                        </h4>

                        <ul id="archive-{{ $year }}-{{ $month }}-{{ $day }}" class="list collapse ps-5" >
                            @foreach( $posts as $post )
                            <li class="pb-5" >
                                <h5><a href="{{ route('post',['post'=>$post]) }}" >{{ $post->title }}</a></h5>
                                <h6 class="text-black-50" >by <em>{{ ucwords($post->author->name) }}</em></h6>
                            </li>
                            @endforeach
                        </ul>

                    </li>
                    @endforeach
                </ul>

            </li>
            @endforeach
        </ul>

    </li>
    @endforeach
</ul>
@else
    <p>No posts.</p>
@endif
-->


