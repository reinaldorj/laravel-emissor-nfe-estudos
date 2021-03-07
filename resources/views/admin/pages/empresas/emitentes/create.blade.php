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
<form action="{{$action}}" class="form" method="POST">
    @include('admin.includes.alerts')
    @csrf
    @method("{$method}")
    <div class="form-group mt-3" align='right'>
        <button type="submit" class="btn btn-success"><i class="far fa-save fa-lg"></i></button>
    </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="razao_social">Razão social:</label>
                        <input type="text" name="razao_social" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->razao_social : old('razao_social') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nome_fantasia">Nome fantasia:</label>
                        <input type="text" name="nome_fantasia" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->nome_fantasia : old('razao_social') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cnpj">CNPJ:</label>
                        <input type="text" name="cnpj" id="cnpj" class="form-control" value="{{ isset($empresa) ? $empresa->cnpj : old('cnpj') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ie">Insc. Estadual:</label>
                        <input type="text" name="ie" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->ie : old('ie') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="im">Insc. Municipal:</label>
                        <input type="im" name="im" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->im : old('im') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="fone">Fone:</label>
                        <input type="text" name="fone" id="fone" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->fone : old('fone') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">Celular:</label>
                        <input type="text" name="" id="celular" class="form-control" placeholder="" value="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->email : old('email') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email_contabilidade">Email contabilidate:</label>
                        <input type="email" name="email_contabilidade" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->email_contabilidade : old('email_contabilidade') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cep">cep:</label>
                        <input type="cep" name="cep" id="cep" class="form-control" onblur="buscacep(value)" placeholder="" value="{{ isset($empresa) ? $empresa->cep : old('cep') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="logradouro">logradouro:</label>
                        <input type="logradouro" name="logradouro" id="logradouro" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->logradouro : old('logradouro') }}" readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="numero">numero:</label>
                        <input type="numero" name="numero" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->numero : old('numero') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bairro">bairro:</label>
                        <input type="bairro" name="bairro" id="bairro" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->bairro : old('bairro') }}" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cep">complemento:</label>
                        <input type="complemento" name="complemento" class="form-control" placeholder="" value="{{ isset($empresa) ? $empresa->complemento : old('complemento') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="uf">uf:</label>
                        <input type="uf" name="uf" class="form-control" id="uf" placeholder="" value="{{ isset($empresa) ? $empresa->uf : old('uf') }}" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cidade">cidade:</label>
                        <input type="cidade" name="cidade" class="form-control" id="cidade" placeholder="" value="{{ isset($empresa) ? $empresa->cidade : old('cidade') }}" readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="ibge">ibge:</label>
                        <input type="ibge" name="ibge" class="form-control" id="ibge" placeholder="" value="{{ isset($empresa) ? $empresa->ibge : old('ibge') }}" readonly>
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="regime_tributario">CFOP</label>
                        <select class="form-control" id="regime_tributario" name="regime_tributario">
                            @foreach ($rgtrib as $rg)
                            <option value="{{ $rg->id }}" {{ @$empresa->regime_tributario == $rg->id ? 'selected' : '' }}>{{$rg->tipo}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cnae">CNAE:</label>
                        <input type="" name="cnae" class="form-control" placeholder=""  value="{{ isset($empresa) ? $empresa->cnae : old('cnae') }}">
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