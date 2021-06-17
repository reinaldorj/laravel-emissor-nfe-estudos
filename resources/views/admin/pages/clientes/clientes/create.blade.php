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
        <a class="nav-link" role="tab" href="#endereco" data-toggle="tab" onclick="">Endereço</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" role="tab" href="#info-adicional" data-toggle="tab">Dados adicionais</a>
    </li>
</ul>
<form action="{{$action}}" class="form" method="POST">
    @include('admin.includes.alerts')
    @csrf
    @method("{$method}")
    <div class="form-group mt-3" align='right'>
        <button type="submit" class="btn btn-success"><i class="far fa-save fa-lg"></i></button>
    </div>
    <div class="tab-content mt-5">
        <div role="tabpanel" class="tab-pane active" id="dados-gerais">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" class="form-control" placeholder="" value="{{ isset($cliente) ? $cliente->nome : old('nome') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nome_fantasia">Nome fantasia:</label>
                        <input type="text" name="nome_fantasia" class="form-control" placeholder="" value="{{ isset($cliente) ? $cliente->nome_fantasia : old('razao_socical') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="cnpj">CNPJ:</label>
                        <input type="text" name="cnpj" id="cnpj" class="form-control" placeholder="" value="{{ isset($cliente) ? $cliente->cnpj : old('cnpj') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="cpf">CPF:</label>
                        <input type="text" name="cpf" id="cpf" class="form-control" placeholder=""value="{{ isset($cliente) ? $cliente->cpf : old('cpf') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="fone">Fone:</label>
                        <input type="text" name="fone" id="fone" class="form-control" placeholder="" value="{{ isset($cliente) ? $cliente->fone : old('fone') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="celular">Celular:</label>
                        <input type="text" name="celular" id="celular" class="form-control" placeholder="" value="{{ isset($cliente) ? $cliente->celular : old('celular') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" placeholder="" value="{{ isset($cliente) ? $cliente->email : old('email') }}">
                    </div>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="endereco">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cep">cep:</label>
                        <input type="cep" name="cep" id="cep" class="form-control" onblur="buscacep(value)" placeholder="" value="{{ isset($cliente) ? $cliente->cep : old('cep') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="logradouro">logradouro:</label>
                        <input type="logradouro" name="logradouro" id="logradouro" class="form-control" placeholder="" value="{{ isset($cliente) ? $cliente->logradouro : old('logradouro') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="numero">numero:</label>
                        <input type="numero" name="numero" class="form-control" placeholder="" value="{{ isset($cliente) ? $cliente->numero : old('numero') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bairro">bairro:</label>
                        <input type="bairro" name="bairro" id="bairro" class="form-control" placeholder="" value="{{ isset($cliente) ? $cliente->bairro : old('bairro') }}" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cep">complemento:</label>
                        <input type="complemento" name="complemento" class="form-control" placeholder="" value="{{ isset($cliente) ? $cliente->complemento : old('complemento') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="uf">uf:</label>
                        <input type="uf" name="uf" id="uf" class="form-control" placeholder="" value="{{ isset($cliente) ? $cliente->uf : old('uf') }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cidade">cidade:</label>
                        <input type="cidade" name="cidade" id="cidade" class="form-control" placeholder="" value="{{ isset($cliente) ? $cliente->cidade : old('cidade') }}" readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="ibge">ibge:</label>
                        <input type="ibge" name="ibge" id="ibge" class="form-control" placeholder="" value="{{ isset($cliente) ? $cliente->ibge : old('ibge') }}" readonly>
                    </div>
                </div>
            </div>
        </div>
        
        <div role="tabpanel" class="tab-pane" id="info-adicional">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ie">Insc. Estadual:</label>
                        <input type="ie" name="ie" class="form-control" placeholder="" value="{{ isset($cliente) ? $cliente->ie : old('ie') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="im">Insc. Municipal:</label>
                        <input type="im" name="im" class="form-control" placeholder="" value="{{ isset($cliente) ? $cliente->im : old('im') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="suframa">Suframa:</label>
                        <input type="suframa" name="suframa" class="form-control" placeholder="" value="{{ isset($cliente) ? $cliente->suframa : old('suframa') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="rg">RG:</label>
                        <input type="text" name="rg" class="form-control" placeholder="" value="{{ isset($cliente) ? $cliente->rg : old('rg') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cod_estrangeiro">Cód. Estrangeiro:</label>
                        <input type="" name="cod_estrangeiro" class="form-control" placeholder="" value="{{ isset($cliente) ? $cliente->cod_estrangeiro : old('cod_estrangeiro') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ie_subt_trib">Indicador da IE do Destinatário:</label>
                        <select class="form-control" name="indIEDest" id="indIEDest">
                            <option disabled selected> Selecione um valor </option>
                            @foreach ($indiedest as $i)
                                <option value="{{ $i->id }}" {{ @$cliente->indIEDest == $i->id ? 'selected' : '' }}>{{$i->tipo}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@stop

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
<script type="text/javascript">
      jQuery(function($){
        $('#cep').mask("00000-000");
        $('#cpf').mask("000.000.000-00");
        $('#cnpj').mask("00.000.000/0000-00");
        $('#fone').mask("(00) 0000-0000"); 
        $('#celular').mask("(00) 00000-0000"); 
    });

    function buscacep(cep){
        if(cep.length == 9){
            $.ajax({
            url:`https://viacep.com.br/ws/${cep}/json/`,
            type: 'GET',
            dataType: 'json',
            async: false,
            data: null,
            success: function (data) {
                if(data.erro){
                    alert('CEP não localizado!');
                }else {
                    $("#logradouro").val(data.logradouro);
                    $("#ibge").val(data.ibge);
                    $("#uf").val(data.uf);
                    $("#cidade").val(data.localidade);
                    $("#bairro").val(data.bairro);
                }
            }
            });
        }
    }
</script>

