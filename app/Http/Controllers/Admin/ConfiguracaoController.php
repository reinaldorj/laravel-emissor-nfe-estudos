<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateConfiguracao;
use App\Models\Configuracao;
use App\Models\Emitente;

class ConfiguracaoController extends Controller
{
    private $repository, $emitentes;

    public function __construct(Configuracao $repository, Emitente $emitentes)
    {
        $this->repository = $repository;
        $this->emitentes = $emitentes;
    }

    public function index()
    {
        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title' => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.configuracoes.index'), 'title' => 'Configuração nota'];
        $data['title']          = 'Configuração nota';
        $data['configuracoes']  = $this->repository->with('emitente')->paginate(10);
        $data['create']         = route('admin.configuracoes.create');
        return view('admin.pages.notas.configuracoes.index', $data);
    }

    public function create()
    {
        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title'    => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.configuracoes.index'), 'title'     => 'Configuração nota'];
        $data['breadcrumb'][]   = ['link' => route('admin.configuracoes.create'), 'title'    => 'Configuração'];
        $data['title']          = 'Configuracão';
        $data['emitentes']      = $this->emitentes->all();
        $data['action']         = route('admin.configuracoes.store');
        $data['method']         = 'POST';
        return view('admin.pages.notas.configuracoes.create', $data);
    }

    public function edit($id)
    {
        $configuracao = $this->repository->where('id_configuracao', $id)->first();
        if (!$configuracao)
            return redirect()->back();

        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title'    => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.configuracoes.index'), 'title'     => 'Configuração nota'];
        $data['breadcrumb'][]   = ['link' => route('admin.configuracoes.edit', $id), 'title'    => 'Editar Configuração'];
        $data['title']          = 'Editar Configuração';
        $data['configuracao']   = $configuracao;
        $data['emitentes']      = $this->emitentes->all();
        $data['action']         = route('admin.configuracoes.update', $id);
        $data['method']         = 'PUT';
        return view('admin.pages.notas.configuracoes.create', $data);
    }

    public function show($id)
    {
        $cliente = $this->repository->where('id_cliente', $id)->first();
        if (!$cliente)
            return redirect()->back();

        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title'    => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.clientes.index'), 'title'     => 'Clientes'];
        $data['breadcrumb'][]   = ['link' => route('admin.clientes.show', $id), 'title'    => 'Cliente ' . $cliente->nome];
        $data['title']          = 'Cliente ' . $cliente->nome;
        $data['cliente']        = $cliente;
        $data['action']         = route('admin.clientes.delete', $id);
        return view('admin.pages.clientes.clientes.show', $data);
    }

    public function store(StoreUpdateConfiguracao $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('admin.configuracoes.index');
    }

    public function update(StoreUpdateConfiguracao $request, $id)
    {
        $configuracao = $this->repository->where('id_configuracao', $id)->first();
        if (!$configuracao)
            return redirect()->back();

        $configuracao->where('id_configuracao', $id)->update($request->except(['_token', '_method']));
        return redirect()->route('admin.configuracoes.index');
    }

    public function delete($id)
    {
        $cliente = $this->repository->where('id_cliente', $id)->first();
        if (!$cliente)
            return redirect()->back();

        $cliente->where('id_cliente', $id)->delete();
        return redirect()->route('admin.clientes.index');
    }
}
