@extends('layouts.admin')
@section('title', "Delete '".ucwords($post->title)."'" )
@section('content')
<div class="row card p-5 shadow" >
    <div class="card-body" >

        <div class="col-12" >
            <x-tabs-component prefix='posts' :model=$post />
        </div>
        <div class="col-12 py-5" >
            <h1 class="text-capitalize card-title" >Delete '<em>{{ $post->title }}</em>'</h1>
        </div>
        <div class="col-12" >
            <p class="text-center" >You are shure that want delete post '<em>{{ $post->title }}</em>' ?</p>
            <div class="row justify-content-center" >
                <div class="col-1" >
                    <form action="{{ route('posts.destroy',compact('post')) }}?answer=1" method="POST" >
                        @csrf
                        <input type="hidden" name="_method" value="DELETE" >
                        <button class="btn btn-danger" >YES</button>
                    </form>
                </div>
                <div class="col-1" >
                    <a class="btn btn-success" href="{{ route('posts.show',compact('post')) }}" >NO</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
