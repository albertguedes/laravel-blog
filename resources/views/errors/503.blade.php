@extends('layouts.error')
@section('title','503 - Service Unavailable')
@section('description','Error 503 - Service Unavailable')
@section('content')
<div class="row" >
    <div class="col-12 text-center pb-3" >
        <h1 class="text-uppercase pb-3" >503 - Service Unavailable</h1>
        <p>Tente novamente mais tarde ou reporte o problema enviando uma mensagem para o email <a href="mailto:{{ env('CONTACT_EMAIL') }}" >{{ env('CONTACT_EMAIL') }}</a>.</p>
        <p>Perdoe-nos pela inconveniente.</p>
    </div>
</div>
@endsection
