@extends('adminlte::page')

@section('title', "{$title}")

@section('content_header')
<h1>{{$title}} 
    @if ($configuracoes->count() <= 0)
        <a href="{{$create}}" class="btn btn-primary ml-3"><i class="fas fa-plus fa-sm"></i> Novo</a>
    @endif
</h1>
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
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Conguração</th>
                    <th style="text-align: center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($configuracoes as $configuracao)
                    <tr>
                        <td>{{ $configuracao->emitente->razao_social  }}</td> 
                        <td style="text-align: center">
                            <a href="{{route('admin.configuracoes.edit', $configuracao->id_configuracao)}}" class="btn btn-info btn-sm" title="editar"><i class="fas fa-pencil-alt"></i></a>
                        </td>
                    </tr>            
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if (isset($filters))
        {!! $configuracoes->appends($filters)->links() !!}
        @else
        {!! $configuracoes->links() !!}
        @endif
    </div>
</div>
@stop