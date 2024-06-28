@extends('layouts.admin')
@section('title', '403 - Forbidden' )
@section('content')
<div class="row card p-5 shadow" >
    <div class="card-body" >
        <div class="col-12 py-5" >
            <h1 class="text-capitalize card-title" >403 - Forbidden</h1>
            <p>Você não tem permissão para acessar esta página.</p>
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Voltar para a página inicial</a>
        </div>
    </div>
</div>
@endsection
