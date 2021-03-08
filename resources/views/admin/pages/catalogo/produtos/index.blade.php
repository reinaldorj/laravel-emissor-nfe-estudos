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
        <form action="{{ route('admin.produtos.search') }}" method="POST" class="form form-inline">
            @csrf
            <div class="input-group">
                <input class="form-control" type="text" name="filter" placeholder="Nome" value="{{ @$pesquisa ? $pesquisa : '' }}"/>
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="fas fa-filter fa-sm"></i> Filtrar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th style="text-align: center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $produto)
                    <tr>
                        <td>{{ $produto->produto }}</td> 
                        <td style="text-align: center">
                            <a href="{{ route('admin.produtos.show', $produto->id_produto) }}" class="btn btn-warning btn-sm" title="detalhes"><i class="far fa-eye"></i></a>
                            <a href="{{ route('admin.produtos.edit', $produto->id_produto) }}" class="btn btn-info btn-sm" title="editar"><i class="fas fa-pencil-alt"></i></a>
                        </td>
                    </tr>            
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if (isset($filters))
        {!! $produtos->appends($filters)->links() !!}
        @else
        {!! $produtos->links() !!}
        @endif
    </div>
</div>
@stop