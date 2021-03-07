<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Unidade;
use App\Http\Requests\StoreUpdateProduto;
use App\Models\cfop;
use App\Models\UnidadeMedida;
use App\Models\UnidadePeso;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    private $repository, $unidades, $cfops, $undpeso, $undmedida;

    public function __construct(Produto $produto, Unidade $unidade, cfop $cfops, UnidadeMedida $undmedida, UnidadePeso $undpeso)
    {
        $this->repository   = $produto;
        $this->unidades     = $unidade;
        $this->cfops        = $cfops;
        $this->undmedida    = $undmedida;
        $this->undpeso      = $undpeso;
    }

    public function index()
    {
        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title' => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.produtos.index'), 'title' => 'Produtos'];
        $data['produtos']       = $this->repository->oldest()->paginate(10);
        $data['title']          = 'Produtos';
        $data['create']         = route('admin.produtos.create');
        return view('admin.pages.catalogo.produtos.index', $data);
    }

    public function search(Request $request)
    {
        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title' => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.produtos.index'), 'title' => 'Produtos'];
        $data['produtos']       = $this->repository->search($request->filter);
        $data['filters']        = $request->except('_token');
        $data['pesquisa']       = $request->filter;
        $data['title']          = 'Produtos';
        $data['create']         = route('admin.produtos.create');
        return view('admin.pages.catalogo.produtos.index', $data);
    }

    public function create()
    {
        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title'    => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.produtos.index'), 'title'     => 'Produtos'];
        $data['breadcrumb'][]   = ['link' => route('admin.produtos.create'), 'title'    => 'Novo produto'];
        $data['title']          = 'Novo produto';
        $data['unidades']       = $this->unidades->all();
        $data['undpeso']        = $this->undpeso->all();
        $data['undmedida']      = $this->undmedida->all();
        $data['cfops']          = $this->cfops->all();
        $data['action']         = route('admin.produtos.store');
        $data['method']         = 'POST';
        return view('admin.pages.catalogo.produtos.create', $data);
    }

    public function edit($id)
    {
        $produto = $this->repository->where('id_produto', $id)->first();
        if (!$produto)
            return redirect()->back();

        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title'    => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.produtos.index'), 'title'     => 'Produtos'];
        $data['breadcrumb'][]   = ['link' => route('admin.produtos.edit', $id), 'title'    => 'Editar produto ' . $produto->produto];
        $data['title']          = 'Editar produto ' . $produto->produto;
        $data['unidades']       = $this->unidades->all();
        $data['undpeso']        = $this->undpeso->all();
        $data['undmedida']      = $this->undmedida->all();
        $data['produto']        = $produto;
        $data['cfops']          = $this->cfops->all();
        $data['action']         = route('admin.produtos.update', $id);
        $data['method']         = 'PUT';
        return view('admin.pages.catalogo.produtos.create', $data);
    }

    public function store(StoreUpdateProduto $request)
    {
        //dd($request->quantidade);
        if (!isset($request->gtin))
            $request->merge(['gtin' => 'SEM GTIN']);

        $this->repository->create($request->all());
        return redirect()->route('admin.produtos.index');
    }

    public function update(StoreUpdateProduto $request, $id)
    {
        $produto = $this->repository->where('id_produto', $id);
        if (!$produto)
            return redirect()->back();

        if (!isset($request->gtin))
            $request->merge(['gtin' => 'SEM GTIN']);

        $produto->update($request->except(['_token', '_method']));
        return redirect()->route('admin.produtos.index');
    }

    public function show($id)
    {
        $produto = $this->repository->where('id_produto', $id)->first();
        if (!$produto)
            return redirect()->back();

        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title'    => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.produtos.index'), 'title'     => 'Produtos'];
        $data['breadcrumb'][]   = ['link' => route('admin.produtos.show', $id), 'title'    => 'Produto ' . $produto->produto];
        $data['title']          = 'Produto ' . $produto->produto;
        $data['produto']        = $produto;
        $data['action']         = route('admin.produto.delete', $id);
        return view('admin.pages.catalogo.produtos.show', $data);
    }

    public function delete($id)
    {
        $produto = $this->repository->where('id_produto', $id)->first();
        if (!$produto)
            return redirect()->back();

        $produto->where('id_produto', $id)->delete();
        return redirect()->route('admin.produtos.index');
    }
}
