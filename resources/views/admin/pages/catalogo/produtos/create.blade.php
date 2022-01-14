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
{{-- {!! $form !!} --}}
<div class="card">
    <div class="card-body">
        @include('admin.includes.alerts')
        <form action="{{ $action }}" class="form" method="POST">
            @csrf
            @method("{$method}")
            <div class="form-group mt-3" align='right'>
                <button type="submit" class="btn btn-success"><i class="far fa-save fa-lg"></i></button>
            </div>

            <ul class="nav nav-tabs mt-4">
                <li class="nav-item">
                    <a class="nav-link active" role="tab" href="#dados-gerais" data-toggle="tab">Dados gerais</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" role="tab" href="#estoque" data-toggle="tab" onclick="">Estoque e medidas</a>
                </li>
            </ul>

            <div class="tab-content mt-5">
                <div role="tabpanel" class="tab-pane active" id="dados-gerais">
                    <div class="form-group">
                        <label for="produto">Titulo do produto:</label>
                        <input type="text" name="produto" class="form-control" placeholder="Nome:" value="{{ isset($produto) ? $produto->produto : old('produto') }}">
                    </div>
        
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Unidade</label>
                                <select class="form-control" id="id_unidade" name="id_unidade">
                                    <option disabled selected> Selecione um opção </option>
                                    @foreach ($unidades as $unidade)
                                        <option value="{{$unidade->id_unidade}}" {{ @$produto->id_unidade == $unidade->id_unidade ? 'selected' : '' }}>{{$unidade->unidade}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="preco">Preço:</label>
                                <input type="text" name="preco" class="form-control" placeholder="0.00" value="{{ isset($produto) ? $produto->preco : old('preco') }}">
                            </div>
                        </div>
                    </div>
        
                    <h5 align='center'> Dados complementares </h5>
                    <hr>
        
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">CFOP</label>
                                <select class="form-control" id="cfop" name="cfop">
                                    <option disabled selected> Selecione um opção </option>
                                    @foreach ($cfops as $cfop)
                                        <option value="{{$cfop->codigo_cfop}}" {{ @$produto->cfop == $cfop->codigo_cfop ? 'selected' : '' }}>{{$cfop->desc_cfop}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="extipi">Exceção tabela IPI</label>
                                <select class="form-control" id="" name="extipi">
                                    <option disabled selected> Selecione uma opção </option>
                                    @foreach ($extipi as $tip)
                                        <option value="{{$tip->id_extipi}}" {{ @$produto->extipi == $tip->id_extipi ? 'selected' : '' }}>{{$tip->extipi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="sku">SKU:</label>
                                <input type="text" name="sku" class="form-control" placeholder="" value="{{ isset($produto) ? $produto->sku : old('sku') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gtin">EAN/GTIN:</label>
                                <input type="text" name="gtin" class="form-control" value="{{ isset($produto) ? $produto->gtin : old('gtin') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="ncm">NCM:</label>
                                <input type="text" name="ncm" class="form-control" placeholder="" value="{{ isset($produto) ? $produto->ncm : old('ncm') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cest">Código CEST:</label>
                                <input type="text" name="cest" class="form-control" placeholder="" value="{{ isset($produto) ? $produto->cest : old('cest') }}">
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cbenef">Código Benef. Fiscal na UF:</label>
                                <input type="text" name="cbenef" class="form-control" placeholder="" value="{{ isset($produto) ? $produto->cbenef : old('cbenef') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mva">MVA:</label>
                                <input type="text" name="mva" class="form-control" placeholder="0.00" value="{{ isset($produto) ? $produto->mva : old('mva') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nfci">NFCI:</label>
                                <select class="form-control" id="nfci" name="nfci">
                                    <option disabled selected> Selecione uma opção </option>
                                    @foreach ($nfci as $n)
                                        <option value="{{$n->id_nfci}}" {{ @$produto->nfci == $n->id_nfci ? 'selected' : '' }}>{{$n->nfci}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                    </div> 
                </div>

                <div role="tabpanel" class="tab-pane" id="estoque">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quantidade">Quantidade: </label>
                                <input type="number" name="quantidade" class="form-control" value="{{ isset($produto) ? $produto->quantidade : old('quantidade') }}">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-5">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="peso">Peso: </label>
                                <input type="number" name="peso" class="form-control" value="{{ isset($produto) ? $produto->peso : old('peso') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_und_peso">Unidade de peso</label>
                                <select class="form-control" id="id_und_peso" name="id_und_peso">
                                    <option disabled selected> Selecione uma opção </option>
                                    @foreach ($undpeso as $und)
                                        <option value="{{$und->id_und_peso}}" {{ @$produto->id_und_peso == $und->id_und_peso ? 'selected' : '' }}>{{$und->unidade_peso}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="comprimento">Comprimento: </label>
                                <input type="number" name="comprimento" class="form-control" value="{{ isset($produto) ? $produto->comprimento : old('comprimento') }}">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="largura">Largura: </label>
                                <input type="number" name="largura" class="form-control" value="{{ isset($produto) ? $produto->largura : old('largura') }}">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="altura">Altura: </label>
                                <input type="number" name="altura" class="form-control" value="{{ isset($produto) ? $produto->altura : old('altura') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_und_medida">Unidade de medida</label>
                                <select class="form-control" id="id_und_medida" name="id_und_medida">
                                    <option disabled selected> Selecione uma opção </option>
                                    @foreach ($undmedida as $und)
                                        <option value="{{$und->id_und_medida}}" {{ @$produto->id_und_medida == $und->id_und_medida ? 'selected' : '' }}>{{$und->unidade_medida}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </form>
    </div>
</div>
@stop