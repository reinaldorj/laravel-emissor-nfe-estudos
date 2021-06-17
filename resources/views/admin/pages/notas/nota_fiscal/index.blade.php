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
    @include('admin.includes.alerts')
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{ route('admin.notafiscal.search') }}" method="POST" class="form form-inline">
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
                    <th>Nota</th>
                    <th>Valor compra</th>
                    <th>Status da nota</th>
                    <th style="text-align: center">Ações</th>
                    <th style="text-align: center"><small class="text-success"><strong>NFE</strong></small></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notas as $nota)
                    <tr>
                        <td>{{ $nota->nome  }}</td>
                        <td>{{ $nota->total  }}</td>
                        <td>{{ $nota->status  }}</td> 
                        <td style="text-align: center">
                            <a href="#" class="btn btn-info btn-sm" title=""><i class="fas fa-pencil-alt"></i></a>
                            <a href="#" class="btn btn-warning btn-sm" title="detalhes"><i class="far fa-eye"></i></a>
                        </td>
                        <td style="text-align: center">
                            <a href="{{route('admin.nfe.gerarnfe', $nota->id_nfe)}}" class="btn btn-success btn-xs" title="">Validar XML</a>
                            <a href="{{route('admin.nfe.assinarnfe', $nota->id_nfe)}}" class="btn btn-success btn-xs" title="">Assinar XML</a>
                            <a href="#" class="btn btn-success btn-xs" title="">Enviar NFE</a>
                            <a href="#" class="btn btn-success btn-xs" title="">Autorizar NFE</a>
                            <a href="#" class="btn btn-success btn-xs" title="">DANFE</a>
                        </td>
                    </tr>            
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if (isset($filters))
        {!! $notas->appends($filters)->links() !!}
        @else
        {!! $notas->links() !!}
        @endif
    </div>
</div>
@stop