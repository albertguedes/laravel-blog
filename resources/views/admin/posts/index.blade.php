@extends('layouts.admin')
@section('title','Posts')
@section('content')
<div class="row" >
    <div class="col-12 pt-5" >
        <h1 class="text-capitalize" >Posts</h1>
    </div>
    <div class="col-12 py-5" >
        <a class="btn btn-primary" href="{{ route('posts.create') }}" >Create Post</a>
    </div>
    <div class="col-12" >
        @if( count($posts) > 0)
        <table class="table" >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CREATED</th>
                    <th>UPDATED</th>
                    <th>TITLE</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach( $posts as $post )
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->created_at->format('Y F d h:i') }}</td>
                    <td>{{ $post->updated_at->format('Y F d h:i') }}</td>
                    <td><a href="{{ route('posts.show',compact('post')) }}">{{ $post->title }}</a></td>
                    <td>
                        <a class="btn btn-warning" href="{{ route('posts.edit',compact('post')) }}" >Edit</a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="{{ route('posts.delete',compact('post')) }}" >Delete</a>
                    </td>
                </tr>
                @endforeach
                <tfooter>
                    <tr>
                        <td colspan="6" >
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