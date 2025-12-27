<div class="row" >

    @if(count($posts) > 0)
    <div class="pb-3 col-12" >
        <div class="card" >
            <div class="card-body" >
                <table class="table h6" >
                    <thead>
                        <tr class="text-center" >
                            <th scope="col" >ID</th>
                            <th scope="col" >TITLE</th>
                            <th scope="col" >CREATED AT</th>
                            <th scope="col" >STATUS</th>
                            <th scope="col" ></th>
                            <th scope="col" ></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                        <tr class="align-middle @if(!$post->published) table-secondary @endif" >
                            <th class="text-center" scope="row"  >{{ $post->id }}</th>
                            <td>
                                <a class="text-capitalize" href="{{ route('profile.post', compact('post')) }}" >
                                    {{ $post->title }}
                                </a>
                            </td>
                            <td class="text-center h6" >
                                {{ $post->created_at->format("Y M d") }}<br>
                                {{ $post->created_at->format("h:i:s") }} h
                            </td>
                            <td class="text-center" >
                                @if($post->published)
                                <span class="badge bg-success" >Published</span>
                                @else
                                <span class="badge bg-danger" >Unpublished</span>
                                @endif
                            </td>
                            <td class="p-0 m-0 text-center" >
                                <a class="list-inline-link btn btn-warning" href="{{ route('profile.post.edit', compact('post')) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td class="p-0 m-0 text-center" >
                                <a class="list-inline-link btn btn-danger" href="{{ route('profile.post.delete', compact('post')) }}">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($posts->hasPages())
            <div class="pt-5 border-0 card-footer d-flex justify-content-center">
                {!! $posts->links() !!}
            </div>
            @endif
        </div>
    </div>

    @else
    <div class="col-12" >
        <p>No posts. <a href="{{ route('profile.post.create') }}" >Create one.</a></p>
    </div>
    @endif

</div>
