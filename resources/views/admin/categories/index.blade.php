@extends('layouts.admin')
@section('title','Categories')
@section('content')
<div class="row" >
    <div class="col-12 pt-5" >
        <h1 class="text-capitalize" >Categories</h1>
    </div>
    <div class="col-12 py-5" >
        <a class="btn btn-primary" href="{{ route('categories.create') }}" ><i class="fas fa-plus"></i> Create Category</a>
    </div>
    <div class="col-12" >
        @if( count($categories) > 0)
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
                @foreach( $categories as $category )
                <tr class="align-middle @if(!$category->is_active) bg-secondary @endif"  >
                    <td class="text-center" >{{ $category->id }}</td>
                    <td>{{ $category->created_at->format('Y/m/d h:i') }}</td>
                    <td>{{ $category->updated_at->format('Y/m/d h:i') }}</td>
                    <td><a href="{{ route('categories.show',compact('category')) }}">{{ $category->title }}</a></td>
                    <td class="text-center" >@if($category->is_active)<span class="badge bg-success" >Is Active</span>@else<span class="badge bg-danger" >Not Active</span>@endif</td>
                    <td>
                        <a class="btn btn-warning" href="{{ route('categories.edit',compact('category')) }}" title="Edit Category" ><i class="far fa-edit"></i></a>
                        <a class="btn btn-danger" href="{{ route('categories.delete',compact('category')) }}" title="Delete Category" ><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                @endforeach
                <tfooter>
                    <tr>
                        <td colspan="7" >
                            <div class="d-flex justify-content-center pt-5" >
                            {!! $categories->links() !!}
                            </div>
                        </td>
                    </tr>
                </tfooter>
            </tbody>
        </table>
        @else
        <p>No Categories Created.</p>
        @endif
    </div>
</div>
@endsection