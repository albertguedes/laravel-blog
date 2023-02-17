@extends('layouts.admin')
@section('title', "Delete '".ucwords($category->title)."'" )
@section('content')
<div class="row card shadow" >
    <div class="card-body" >
        <div class="col-12" >
            @include('partials.admin.tabs',compact('routes'))
        </div>
        <div class="col-12" >
            <h1 class="text-capitalize card-title" >Delete '<em>{{ $category->title }}</em>' ?</h1>
        </div>
        <div class="col-12 pt-5" >
            <p class="text-center" >You are shure that want delete post '<em>{{ $category->title }}</em>' ?</p>
            <div class="row justify-content-center" >
                <div class="col-1" >
                    <form action="{{ route('categories.destroy',compact('category')) }}" method="POST" >
                        @csrf
                        <input type="hidden" name="_method" value="DELETE" >
                        <button class="btn btn-danger" >YES</button>
                    </form>
                </div>
                <div class="col-1" >
                    <a class="btn btn-success" href="{{ route('categories.show',compact('category')) }}" >NO</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
