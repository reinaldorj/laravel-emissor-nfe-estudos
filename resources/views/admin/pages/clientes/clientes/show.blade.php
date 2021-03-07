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
    @include('admin.includes.alerts')
    <div class="card-body">
        <ul>
            <li>
                <strong>Cliente: </strong> {{ $cliente->nome }}
            </li>
            <li>
                <strong>Email:</strong> {{ $cliente->email }}
            </li>
        </ul>
    </div>
    <div class="card-footer">
        <!--<a href="" class="btn btn-info" title="editar"><i class="fas fa-pencil-alt"></i></a>-->
        <form action="{{$action}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" title="remover"><i class="far fa-trash-alt"></i></button>
        </form>
    </div>
</div>
@stop