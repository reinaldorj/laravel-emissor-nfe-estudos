@extends('adminlte::page')

@section('title', "{$title}")

@section('content_header')
<h1>{{$title}} <a href="{{$create}}" class="btn btn-primary ml-3"><i class="fas fa-plus fa-sm"></i> Novo</a></h1>
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
    <div class="card-header">
        <form action="{{ route('admin.vendas.search') }}" method="POST" class="form form-inline">
            @csrf
            <div class="input-group">
                <input class="form-control" type="text" name="filter" placeholder="Nome" value="{{ @$pesquisa ? $pesquisa->filter : '' }}"/>
            </div>
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="fas fa-filter fa-sm"></i> Filtrar</button>
            </div>
        </form>
    </div>
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Total Venda</th>
                    <th>Venda Finalizada</th>
                    <th>Data Venda</th>
                    <th style="text-align: center">Ações</th>
                    <th style="text-align: center">Detalhes Venda</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendas as $venda)
                    <tr>
                        <td>{{$venda->cliente->nome}}</td>
                        <th>{{($venda->total > 0) ? 'R$ ' . $venda->total : 'R$ 0.00'}}</th>
                        <th>{{ $venda->finalizado == 'S' ? 'Sim' : 'Não' }}</th>
                        <th> {{databr($venda->data_venda)}} </th>
                        <td style="text-align: center">
                            <a href="{{route('admin.vendas.show', $venda->id_venda)}}" class="btn btn-warning btn-sm" title="detalhes"><i class="far fa-eye"></i></a>
                            <a href="{{route('admin.vendas.edit', $venda->id_venda)}}" class="btn btn-info btn-sm" title="editar"><i class="fas fa-pencil-alt"></i></a>
                            @if ($venda->finalizado == 'S')
                            <a href="{{route('admin.notafiscal.insere', $venda->id_venda)}}" class="btn btn-success btn-sm" title="Emitir notas"> Emitir Nota <i class="fas fa-pen-square"></i></a>
                            @else
                            <button href="#" class="btn btn-default btn-sm" title="Emitir notas" disabled> Emitir Nota <i class="fas fa-pen-square"></i></button>
                            @endif
                        </td>
                        <td style="text-align: center">
                            <a href="{{route('admin.vendas.detalhe', $venda->id_venda)}}" class="btn btn-dark btn-sm" title="detalhes"><i class="fas fa-info-circle"></i></a>
                        </td>
                    </tr>            
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if (isset($filters))
        {!! $vendas->appends($filters)->links() !!}
        @else
        {!! $vendas->links() !!}
        @endif
    </div>
</div>
@stop