@extends('layouts.admin')
@section('title','Users')
@section('content')
<div class="row" >
    <div class="col-12 pt-5" >
        <h1 class="text-capitalize" >Users</h1>
    </div>
    <div class="col-12 py-5" >
        <a class="btn btn-primary" href="{{ route('users.create') }}" >Create User</a>
    </div>
    <div class="col-12" >
        @if( count($users) > 0)
        <table class="table" >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach( $users as $user )
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><a href="{{ route('users.show',compact('user')) }}">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a class="btn btn-warning" href="{{ route('users.edit',compact('user')) }}" >Edit</a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="{{ route('users.delete',compact('user')) }}" >Delete</a>
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