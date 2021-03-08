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
@stop

@section('content')

<ul class="nav nav-tabs mt-4">
    <li class="nav-item">
        <a class="nav-link active" role="tab" href="#dados-gerais" data-toggle="tab">Dados gerais</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" role="tab" href="#emitente" data-toggle="tab" onclick="">Emitente</a>
    </li>
</ul>
<form action="{{$action}}" class="form" method="POST">
    @csrf
    @method("{$method}")

    <div class="form-group mt-3" align='right'>
        <button type="submit" class="btn btn-success"><i class="far fa-save fa-lg"></i></button>
    </div>

    <div class="tab-content mt-5">
        <div role="tabpanel" class="tab-pane active" id="dados-gerais">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="nNF">Num NFe:</label>
                        <input type="text" name="nNF" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->nNF : old('nNF') }}">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="serie ">Serie:</label>
                        <input type="text" name="serie " class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->serie  : old('serie ') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="tpNF">Tipo de operação</label>
                        <select class="form-control" id="" name="tpNF">
                            <option> teste </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">CFOP</label>
                        <select class="form-control" id="" name="">
                            <option> teste </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="cUF ">uf:</label>
                        <input type="text" name="cUF " class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->cUF  : old('cUF ') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nNF">Data Emissão NF:</label>
                        <input type="date" name="nNF" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->nNF : old('nNF') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="serie">Hora emissão NF:</label>
                        <input type="text" name="serie" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->serie  : old('serie ') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nNF">Data Saida/Entrada:</label>
                        <input type="date" name="nNF" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->nNF : old('nNF') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nNF">Hora Saida/Entrada:</label>
                        <input type="date" name="nNF" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->nNF : old('nNF') }}">
                    </div>
                </div>
            </div>

            <div class="mt-5" align="center" style="text-transform: uppercase; font-weight: 400;"><h5>Frestes/Despesas/Descontos</h5></div>
            <hr>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="vFrete ">Frete:</label>
                        <input type="text" name="vFrete " class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->vFrete  : old('vFrete ') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="vSeg ">Seguro:</label>
                        <input type="text" name="vSeg " class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->vSeg  : old('vSeg ') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Despesa:</label>
                        <input type="text" name="" class="form-control" placeholder="" value="{{ isset($empresa) ? '' : old('') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="vDesc">Desconto:</label>
                        <input type="text" name="vDesc" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->vDesc : old('vDesc') }}">
                    </div>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="emitente">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tpNF">Razão Social</label>
                        <select class="form-control" id="" name="tpNF">
                            <option> teste </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="logradouro">Nome Fantasia:</label>
                        <input type="logradouro" name="logradouro" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->logradouro : old('logradouro') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="numero">CNPJ:</label>
                        <input type="numero" name="numero" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->numero : old('numero') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="bairro">Insc Estadua:</label>
                        <input type="bairro" name="bairro" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->bairro : old('bairro') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="bairro">Ins. Est. Subst. Trib.</label>
                        <input type="bairro" name="bairro" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->bairro : old('bairro') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="bairro">Insc. Municipal</label>
                        <input type="bairro" name="bairro" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->bairro : old('bairro') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="numero">Fone:</label>
                        <input type="numero" name="numero" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->numero : old('numero') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bairro">Email:</label>
                        <input type="bairro" name="bairro" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->bairro : old('bairro') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bairro">Email contabilidade.</label>
                        <input type="bairro" name="bairro" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->bairro : old('bairro') }}">
                    </div>
                </div>
            </div>

            <div class="mt-5" align="center" style="text-transform: uppercase; font-weight: 400;"><h5>Endereço do emitente</h5></div>
            <hr>

            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cep">CEP:</label>
                        <input type="complemento" name="complemento" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->complemento : old('complemento') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="uf">Logradouro:</label>
                        <input type="uf" name="uf" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->uf : old('uf') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cidade">Numero:</label>
                        <input type="cidade" name="cidade" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->cidade : old('cidade') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ibge">Bairro:</label>
                        <input type="ibge" name="ibge" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->ibge : old('ibge') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ibge">Complemento:</label>
                        <input type="ibge" name="ibge" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->ibge : old('ibge') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="ibge">UF:</label>
                        <input type="ibge" name="ibge" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->ibge : old('ibge') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ibge">Cidade:</label>
                        <input type="ibge" name="ibge" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->ibge : old('ibge') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="ibge">Ibge:</label>
                        <input type="ibge" name="ibge" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->ibge : old('ibge') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@stop

