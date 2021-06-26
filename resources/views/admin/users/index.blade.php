@extends('layouts.admin')
@section('title','Users')
@section('content')
<div class="row" >
    <div class="col-12 pt-5" >
        <h1 class="text-capitalize" >Users</h1>
    </div>
    <div class="col-12 py-5" >
        <a class="btn btn-primary" href="{{ route('users.create') }}" ><i class="fas fa-plus"></i> Create User</a>
    </div>
    <div class="col-12" >
        @if( count($users) > 0)
        <table class="table table-hover" >
            <thead>
                <tr>
                    <th class="text-center" scope="col" >ID</th>
                    <th scope="col" >USERNAME</th>
                    <th scope="col" >NAME</th>
                    <th class="text-center" scope="col" >IS ACTIVE</th>
                    <th scope="col" ></th>
                </tr>
            </thead>
            <tbody>
                @foreach( $users as $user )
                <tr class="align-middle @if(!$user->is_active) bg-secondary @endif" >
                    <td class="text-center">{{ $user->id }}</td>
                    <td><a href="{{ route('users.show',compact('user')) }}">{{ $user->username }}</a></td>
                    <td>{{ $user->name }}</td>
                    <td class="text-center" >@if($user->is_active)<span class="badge bg-success" >Active</span>@else<span class="badge bg-danger" >Not Active</span>@endif</td>
                    <td>
                        <a class="btn btn-warning" href="{{ route('users.edit',compact('user')) }}" alt="Edit User" ><i class="far fa-edit"></i></a>
                        <a class="btn btn-danger" href="{{ route('users.delete',compact('user')) }}" alt="Delete User" ><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfooter>
                    <tr>
                        <td colspan="5" >
                            <div class="d-flex justify-content-center pt-5" >
                            {!! $users->links() !!}
                            </div>
                        </td>
                    </tr>
            </tfooter>
        </table>
        @else
        <p>No Users Created.</p>
        @endif
    </div>
</div>
@endsection