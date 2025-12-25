@extends('layouts.error')
@section('title','500 - Internal Server Error')
@section('description','Error 505 - Internal Server Error')
@section('content')
<h1 class="text-uppercase pb-3" >500 - Internal Server Error</h1>
<p>
    Try again later or report the problem by sending an email to
    <a href="mailto:{{ env('MAIL_TO_ADDRESS') }}" >{{ env('MAIL_TO_ADDRESS') }}</a>.
</p>
<p>Sorry for the inconvenience.</p>
@endsection
