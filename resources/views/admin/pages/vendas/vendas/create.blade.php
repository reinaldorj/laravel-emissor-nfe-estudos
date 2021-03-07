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
    <div class="card-body">
        @include('admin.includes.alerts')
        <form action="{{ $action }}" class="form" method="POST" autocomplete="off">
            @csrf
            @method("{$method}")
            <div class="form-group mt-3" align='right'>
                <button type="submit" class="btn btn-success"><i class="far fa-save fa-lg"></i></button>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="id_cliente">Cliente</label>
                        <input type="text" name="cliente" id="cliente" placeholder="Procurar o cliente" class="form-control" onkeyup="venda.pesquisa('cliente')" value="{{ isset($venda) ? $venda->cliente->nome : '' }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="data_venda">Data:</label>
                        <input type="date" name="data_venda" class="form-control" value="{{ isset($venda) ? $venda->data_venda : hoje() }}" readonly>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="hora_venda">Hora:</label>
                        <input type="time" name="hora_venda" class="form-control" value="{{ isset($venda) ? $venda->hora_venda : agora() }}" readonly>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id_cliente" id="id_cliente" value="{{ isset($venda) ? $venda->cliente->id_cliente : '' }}">
            <input type="hidden" name="finalizado" id="finalizado" value="{{ isset($venda) ? $venda->finalizado : 'N' }}">
        </form>
@stop
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script>
var CSRF_TOKEN = '{{csrf_token()}}';
var venda = {};
    venda = {
        pesquisa: function (input) {
            $("#" + input).autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "{{ route('admin.vendas.pesquisa') }}",
                        method: 'GET',
                        dataType: "json",
                        data: { 
                            CSRF_TOKEN,
                            pesquisa: request.term },
                        success: function (data) {
                            response($.map(data, function (obj, key) {
                                if (request.term != -1) {
                                    console.log(obj);
                                    return {
                                         label: (input == 'cliente') ? obj.nome : null,
                                         value: (input == 'cliente') ? obj.id_cliente : null
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
                    venda.clienteselect(input, ui.item.value, ui.item.label);
                }
            })
        },
        clienteselect: function (input, id, desc){
            $(`#${input}`).val(desc);
            $(`#id_${input}`).val(id);
        }
    }
</script>


