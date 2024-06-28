@extends('layouts.error')
@section('title','500 - Internal Server Error')
@section('description','Error 505 - Internal Server Error')
@section('content')
<div class="row" >
    <div class="col-12 text-center pb-3" >
        <h1 class="text-uppercase pb-3" >500 - Internal Server Error</h1>
        <p>Tente novamente mais tarde ou reporte o problema enviando uma mensagem para o email <a href="mailto:{{ env('CONTACT_EMAIL') }}" >{{ env('CONTACT_EMAIL') }}</a>.</p>
        <p>Perdoe-nos pela inconveniente.</p>
    </div>
</div>
@endsection
