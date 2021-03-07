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
<div class="card">

    <form action="{{route('admin.vendas.finalizavenda', $venda->id_venda)}}" class="form" method="POST">
        @csrf
        @method("PUT")
        <div class="form-group mt-3" align='right'>
            <button type="submit" class="btn btn-success mr-1" {{ ($venda->finalizado == 'S') ? 'disabled' : '' }}> {{ ($venda->finalizado == 'S') ? 'Pedido finalizado' : 'Finalizar venda' }} <i class="far fa-save fa-lg"></i></button>
        </div>
        <input type="hidden" name='total' value="{{$totalvenda}}">
        <input type="hidden" name="finalizado" value="S">
    </form>
    

    <div class="card-body">
        @include('admin.includes.alerts')
        <h5 align="center">Produtos da venda</h5>
        <hr>
    
        <div class="card">
            <div class="card-header">
                <form method="POST" class="form form-inline" autocomplete="off" action="{{$action}}">
                    @csrf
                    @method("{$method}")
                    <div class="input-group">
                        <input class="form-control" type="text" name="produto" id="produto" onkeyup="venda.pesquisaproduto('produto')" placeholder="Nome do produto" value="" {{ ($venda->finalizado == 'S') ? 'readonly' : '' }}/>
                    </div>
                    <div class="input-group ml-2">
                        <input class="form-control" type="number" name="qtde" id="qtde" placeholder="Quantidade" onchange="venda.qtdproduto(value)" min="1" {{ ($venda->finalizado == 'S') ? 'readonly' : '' }}/>
                    </div>
                    <div class="input-group ml-2">
                        <input class="form-control" type="text" name="valor" id="valor" placeholder="total" value="" readonly/>
                        <div class="input-group-btn ml-2">
                            <button class="btn btn-info" type="submit" {{ ($venda->finalizado == 'S') ? 'disabled' : '' }}> Adicionar </button>
                        </div>
                    </div>
                    <input type="hidden" name="id_produto" id="id_produto">
                    <input type="hidden" name="id_venda" id="id_venda" value="{{$venda->id_venda}}">
                    <input type="hidden" name="id_cliente" id="id_cliente" value="{{$venda->id_cliente}}">
                </form>
            </div>
            <div class="card-body">
                <table class="table table-condensed">
                    <thead>
                        <tr><strong>Valor total da venda: </strong> {{$totalvenda}}</tr>
                        <tr>
                            <th>Produto</th>
                            <th style="text-align: center">Valor</th>
                            <th style="text-align: center">Quantidade</th>
                            <th style="text-align: center">Total</th>
                            <th style="text-align: center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($itensvenda as $item)
                            <tr>
                                <td>{{$item->produto->produto}}</td> 
                                <td style="text-align: center"> {{$item->produto->preco}} </td>
                                <td style="text-align: center"> {{$item->qtde}} </td>
                                <td style="text-align: center"> {{$item->valor}} </td>
                                <form action="{{route('admin.vendas.deleteitem', [$item->id_item_venda, $item->id_venda]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <td style="text-align: center"><button class="btn btn-danger" type="submit" {{ ($venda->finalizado == 'S') ? 'disabled' : '' }}><i class="far fa-trash-alt"></i></button></td>
                                </form>
                            </tr> 
                        @endforeach          
                    </tbody>
                </table>
            </div>    
        </div>
    </div>
</div>
@stop

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script>
var CSRF_TOKEN = '{{csrf_token()}}';
var preco_original;
var venda = {};
    venda = {
        pesquisaproduto: function (input) {
            if($(`#${input}`).val().length == 0){
                $(`#id_${input}`).val(null);
                $(`#valor`).val(null);
            }
            $("#" + input).autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "{{ route('admin.vendas.pesquisaProduto') }}",
                        method: 'GET',
                        dataType: "json",
                        data: { 
                            CSRF_TOKEN,
                            pesquisa: request.term },
                        success: function (data) {
                            response($.map(data, function (obj, key) {
                                if (request.term != -1) {
                                    return {
                                         label: obj.produto,
                                         value: obj
                                     }
                                } else {
                                     return null;
                                 }
                            }));
                        }
                    })
                },
                minLength: 1,
                focus: function (event, ui) {
                    event.preventDefault();
                },
                select: function (event, ui) {
                    event.preventDefault();
                    venda.produtoselect(input, ui.item.value, ui.item.label);
                }
            })
        },
        produtoselect: function (input, obj, desc){
            $(`#${input}`).val(desc);
            $(`#id_${input}`).val(obj.id_produto);
            $('#valor').val(obj.preco);
            $('#qtde').val('1');
            preco_original = obj.preco;
        },
        qtdproduto: function (qtd){
            if($("#id_produto").val()){
                var total = qtd * parseFloat(preco_original);
                $('#valor').val(total);
            }
        }
    }
</script>


