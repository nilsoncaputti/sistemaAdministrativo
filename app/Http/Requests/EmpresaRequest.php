@extends('layouts.app')

@section('title')
<h1>Detalhes do {{ $empresa->tipo }} - {{ $empresa->nome }}</h1>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('empresas.index') }}?tipo={{ $empresa->tipo }}">Listagem de {{ $empresa->tipo }}</a>
</li>

<li class="breadcrumb-item">
    <a href="{{ route('empresas.show', $empresa) }}">Detalhes do {{ $empresa->tipo }}</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> {{ $empresa->nome }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection