<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateEmitentes;
use App\Models\Emitente;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    private $repository;
    //para consulta de cnpjs https://receitaws.com.br/v1/cnpj/

    public function __construct(Emitente $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title' => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.empresas.index'), 'title' => 'Empresas'];
        $data['empresas']       = $this->repository->oldest()->paginate(10);
        $data['title']          = 'Empresas';
        $data['create']         = route('admin.empresas.create');
        return view('admin.pages.empresas.emitentes.index', $data);
    }

    public function search(Request $request)
    {
        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title' => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.empresas.index'), 'title' => 'Empresas'];
        $data['empresas']       = $this->repository->search($request->filter);
        $data['filters']        = $request->except('_token');
        $data['pesquisa']       = $request->filter;
        $data['title']          = 'Empresas';
        $data['create']         = route('admin.empresas.create');
        return view('admin.pages.empresas.emitentes.index', $data);
    }

    public function create()
    {
        $data['breadcrumb'][]   = ['link' => route('admin.empresas.index'), 'title'    => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.empresas.index'), 'title'     => 'empresas'];
        $data['breadcrumb'][]   = ['link' => route('admin.empresas.create'), 'title'    => 'Nova Empresa'];
        $data['rgtrib']         = (object)[
            (object)['id' => 1, 'tipo' => 'Simples nacional'],
            (object)['id' => 2, 'tipo' => 'Lucro presumido'],
            (object)['id' => 3, 'tipo' => 'Lucro Real'],
        ];
        $data['title']          = 'Nova empresa';
        $data['action']         = route('admin.empresas.store');
        $data['method']         = 'POST';
        return view('admin.pages.empresas.emitentes.create', $data);
    }

    public function edit($id)
    {
        $empresa = $this->repository->where('id_emitente', $id)->first();
        if (!$empresa)
            return redirect()->back();

        $data['breadcrumb'][]   = ['link' => route('admin.empresas.index'), 'title'    => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.empresas.index'), 'title'     => 'empresas'];
        $data['breadcrumb'][]   = ['link' => route('admin.empresas.edit', $id), 'title'    => 'Editar empresa ' . $empresa->razao_socical];
        $data['title']          = 'Editar empresa ' . $empresa->razao_socical;
        $data['rgtrib']         = (object)[
            (object)['id' => 1, 'tipo' => 'Simples nacional'],
            (object)['id' => 2, 'tipo' => 'Lucro presumido'],
            (object)['id' => 3, 'tipo' => 'Lucro Real'],
        ];
        $data['empresa']        = $empresa;
        $data['action']         = route('admin.empresas.update', $id);
        $data['method']         = 'PUT';
        return view('admin.pages.empresas.emitentes.create', $data);
    }

    public function show($id)
    {
        $empresa = $this->repository->where('id_emitente', $id)->first();
        if (!$empresa)
            return redirect()->back();

        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title'    => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.empresas.index'), 'title'     => 'Empresas'];
        $data['breadcrumb'][]   = ['link' => route('admin.empresas.show', $id), 'title'    => 'Empresa ' . $empresa->razao_socical];
        $data['title']          = 'Empresa ' . $empresa->razao_socical;
        $data['empresa']        = $empresa;
        $data['action']         = route('admin.empresas.delete', $id);
        return view('admin.pages.empresas.emitentes.show', $data);
    }

    public function store(StoreUpdateEmitentes $request)
    {
        $cnpjvalido = validaCNPJ($request->cnpj);
        if (!$cnpjvalido)
            return redirect()->back()->withErrors('Informe um cnpj válido!');
        $request->merge(['iest' => '1']);
        $this->repository->create($request->all());
        return redirect()->route('admin.empresas.index');
    }

    public function update(StoreUpdateEmitentes $request, $id)
    {
        $empresa = $this->repository->where('id_emitente', $id);
        if (!$empresa)
            return redirect()->back();

        $cnpjvalido = validaCNPJ($request->cnpj);
        if (!$cnpjvalido)
            return redirect()->back()->withErrors('Informe um cnpj válido!');

        $empresa->update($request->except(['_token', '_method']));
        return redirect()->route('admin.empresas.index');
    }

    public function delete($id)
    {
        $empresa = $this->repository->where('id_emitente', $id)->first();
        if (!$empresa)
            return redirect()->back();

        $empresa->where('id_emitente', $id)->delete();
        return redirect()->route('admin.empresas.index');
    }
}
