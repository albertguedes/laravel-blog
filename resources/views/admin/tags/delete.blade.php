@extends('layouts.admin')
@section('title', "Delete '".ucwords($tag->title)."'" )
@section('content')
<div class="row" >
    <div class="col-12" >
        @include('partials.admin.tabs',compact('routes'))
    </div>
    <div class="col-12 pt-5" >
        <h1 class="text-capitalize" >Delete '<em>{{ $tag->title }}</em>'</h1>
    </div>
    <div class="col-12 pt-5" >
        <p class="text-center" >You are shure that want delete tag '<em>{{ $tag->title }}</em>' ?</p>
        <div class="row justify-content-center" >
            <div class="col-1" >
                <form action="{{ route('tags.destroy',compact('tag')) }}?answer=1" method="tag" >
                    @csrf
                    <input type="hidden" name="_method" value="DELETE" >
                    <button class="btn btn-danger" >YES</button>
                </form>
            </div>
            <div class="col-1" >
                <a class="btn btn-success" href="{{ route('tags.show',compact('tag')) }}" >NO</a>
            </div>
        </div>
    </div>
</div>
@endsection
