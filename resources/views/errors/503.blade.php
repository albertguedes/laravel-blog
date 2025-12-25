@extends('layouts.error')
@section('title','503 - Service Unavailable')
@section('description','Error 503 - Service Unavailable')
@section('content')
<h1 class="text-uppercase pb-3" >503 - Service Unavailable</h1>
<p>
    Try again later or report the problem by sending an email to
    <a href="mailto:{{ env('MAIL_TO_ADDRESS') }}" >{{ env('MAIL_TO_ADDRESS') }}</a>.
</p>
<p>Sorry for the inconvenience.</p>
@endsection
