@extends('layouts.admin')
@section('title','Tags')
@section('content')
<div class="row" >
    <div class="col-12 pt-5" >
        <h1 class="text-capitalize" >Tags</h1>
    </div>
    <div class="col-12 py-5" >
        <a class="btn btn-primary" href="{{ route('tags.create') }}" ><i class="fas fa-plus"></i> Create Tag</a>
    </div>
    <div class="col-12" >
        @if( count($tags) > 0)
        <table class="table table-hover" >
            <thead>
                <tr>
                    <th class="text-center"  scope="col" >ID</th>
                    <th scope="col" >CREATED</th>
                    <th scope="col">UPDATED</th>
                    <th scope="col">TITLE</th>
                    <th class="text-center" scope="col" >IS ACTIVE</th>
                    <th scope="col" ></th>
                </tr>
            </thead>
            <tbody>
                @foreach( $tags as $tag )
                <tr class="align-middle @if(!$tag->is_active) bg-secondary @endif"  >
                    <td class="text-center" >{{ $tag->id }}</td>
                    <td>{{ $tag->created_at->format('Y/m/d h:i') }}</td>
                    <td>{{ $tag->updated_at->format('Y/m/d h:i') }}</td>
                    <td><a href="{{ route('tags.show',compact('tag')) }}">{{ $tag->title }}</a></td>
                    <td class="text-center" >@if($tag->is_active)<span class="badge bg-success" >Is Active</span>@else<span class="badge bg-danger" >Not Active</span>@endif</td>
                    <td>
                        <a class="btn btn-warning" href="{{ route('tags.edit',compact('tag')) }}" title="Edit Tag" ><i class="far fa-edit"></i></a>
                        <a class="btn btn-danger" href="{{ route('tags.delete',compact('tag')) }}" title="Delete Tag" ><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                @endforeach
                <tfooter>
                    <tr>
                        <td colspan="7" >
                            <div class="d-flex justify-content-center pt-5" >
                            {!! $tags->links() !!}
                            </div>
                        </td>
                    </tr>
                </tfooter>
            </tbody>
        </table>
        @else
        <p>No Tags Created.</p>
        @endif
    </div>
</div>
@endsection