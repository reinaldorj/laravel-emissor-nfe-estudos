@extends('adminlte::page')

@section('title', "{$title}")

@section('content_header')
<h1>{{$title}}</h1>
    <ol class="breadcrumb mt-2 mb-2">
        @foreach ($breadcrumb as $bread)
        <li class="breadcrumb-item" aria-current="page">
            <a href="{{isset($bread['link']) ? $bread['link'] : '#'}}" class="ml-2">{{$bread['title']}}</a>
        </li>
        @endforeach
    </ol>
    @include('admin.includes.alerts')
@stop

@section('content')

<form action="{{$action}}" class="form" method="POST">
    @csrf
    @method("{$method}")
    <div class="form-group mt-3" align='right'>
        <button type="submit" class="btn btn-success"><i class="far fa-save fa-lg"></i></button>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label for="layout ">Layout:</label>
                <input type="text" name="layout" class="form-control" placeholder="" value="{{ isset($configuracao) ? $configuracao->layout  : old('layout') }}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="nfe_serie ">NFE série:</label>
                <input type="text" name="nfe_serie" class="form-control" placeholder="" value="{{ isset($configuracao) ? $configuracao->nfe_serie  : old('nfe_serie') }}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="tipo_nota_padrao ">Tipo padrão:</label>
                <input type="text" name="tipo_nota_padrao" class="form-control" placeholder="" value="{{ isset($configuracao) ? $configuracao->tipo_nota_padrao  : old('tipo_nota_padrao') }}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="nfe_ambiente ">NFE ambiente:</label>
                <input type="text" name="nfe_ambiente" class="form-control" placeholder="" value="{{ isset($configuracao) ? $configuracao->nfe_ambiente  : old('nfe_ambiente') }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label for="nfe_versao ">NFE versão:</label>
                <input type="text" name="nfe_versao" class="form-control" placeholder="" value="{{ isset($configuracao) ? $configuracao->nfe_versao  : old('nfe_versao') }}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="ultimanfe ">ultimanefe</label>
                <input type="text" name="ultimanfe" class="form-control" placeholder="" value="{{ isset($configuracao) ? $configuracao->ultimanfe  : old('ultimanfe') }}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="natureza_padrao ">Natureza padrão</label>
                <input type="text" name="natureza_padrao" class="form-control" placeholder="" value="{{ isset($configuracao) ? $configuracao->natureza_padrao  : old('natureza_padrao') }}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="indFinal ">Ind Final</label>
                <input type="text" name="indFinal" class="form-control" placeholder="" value="{{ isset($configuracao) ? $configuracao->indFinal  : old('indFinal') }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label for="tipo_frete ">Tipo do frete</label>
                <input type="text" name="tipo_frete" class="form-control" placeholder="" value="{{ isset($configuracao) ? $configuracao->tipo_frete  : old('tipo_frete') }}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="certificado_digital ">Certificado digital</label>
                <input type="text" name="certificado_digital" class="form-control" placeholder="" value="{{ isset($configuracao) ? $configuracao->certificado_digital  : old('certificado_digital') }}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="senha ">Senha certificado</label>
                <input type="text" name="senha" class="form-control" placeholder="" value="{{ isset($configuracao) ? $configuracao->senha  : old('senha') }}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="empresa_padrao">Empresa padrão</label>
                <select class="form-control select2" id="" name="empresa_padrao">
                    <option disabled selected>Selecione a empresa</option>
                    @foreach ($emitentes as $emitente)
                        <option value="{{$emitente->id_emitente}}" {{ @$configuracao->empresa_padrao == $emitente->id_emitente ? 'selected' : '' }}>{{$emitente->razao_social}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</form>
@stop

