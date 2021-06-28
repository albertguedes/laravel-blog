@extends('layouts.admin')
@section('title','Posts')
@section('content')
<div class="row" >
    <div class="col-12 pt-5" >
        <h1 class="text-capitalize" >Posts</h1>
    </div>
    <div class="col-12 py-5" >
        <a class="btn btn-primary" href="{{ route('posts.create') }}" ><i class="fas fa-plus"></i> Create Post</a>
    </div>
    <div class="col-12" >
        @if( count($posts) > 0)
        <table class="table table-hover" >
            <thead>
                <tr>
                    <th class="text-center"  scope="col" >ID</th>
                    <th scope="col" >CREATED</th>
                    <th scope="col">UPDATED</th>
                    <th scope="col">AUTHOR</th>
                    <th scope="col">TITLE</th>
                    <th class="text-center" scope="col"  >PUBLISHED</th>
                    <th scope="col" ></th>
                </tr>
            </thead>
            <tbody>
                @foreach( $posts as $post )
                <tr class="align-middle @if(!$post->published) bg-secondary @endif"  >
                    <td class="text-center" >{{ $post->id }}</td>
                    <td>{{ $post->created_at->format('Y/m/d h:i') }}</td>
                    <td>{{ $post->updated_at->format('Y/m/d h:i') }}</td>
                    <td><a href="{{ route('users.show',['user'=>$post->author]) }}">{{ $post->author->username }}</a></td>
                    <td><a href="{{ route('posts.show',compact('post')) }}">{{ $post->title }}</a></td>
                    <td class="text-center" >@if($post->published)<span class="badge bg-success" >Published</span>@else<span class="badge bg-danger" >Not Published</span>@endif</td>
                    <td>
                        <a class="btn btn-warning" href="{{ route('posts.edit',compact('post')) }}" title="Edit Post" ><i class="far fa-edit"></i></a>
                        <a class="btn btn-danger" href="{{ route('posts.delete',compact('post')) }}" title="Delete Post" ><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                @endforeach
                <tfooter>
                    <tr>
                        <td colspan="7" >
                            <div class="d-flex justify-content-center pt-5" >
                            {!! $posts->links() !!}
                            </div>
                        </td>
                    </tr>
                </tfooter>
            </tbody>
        </table>
        @else
        <p>No Posts Created.</p>
        @endif
    </div>
</div>
@endsection