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
    private $repository, $unidades, $cfops, $undpeso, $undmedida, $extipi, $nfci;

    public function __construct(Produto $produto, Unidade $unidade, cfop $cfops, UnidadeMedida $undmedida, UnidadePeso $undpeso)
    {
        $this->repository   = $produto;
        $this->unidades     = $unidade;
        $this->cfops        = $cfops;
        $this->undmedida    = $undmedida;
        $this->undpeso      = $undpeso;
        $this->extipi = (object)[
            (object)['id_extipi' => 01, 'extipi' => 01],
            (object)['id_extipi' => 02, 'extipi' => 02],
            (object)['id_extipi' => 03, 'extipi' => 03]
        ];
        $this->nfci = (object) [
            (object) ['id_nfci' => 0, 'nfci' => '0 – Nacional, exceto as indicadas nos códigos 3, 4, 5 e 8'],
            (object) ['id_nfci' => 1, 'nfci' => '1 – Estrangeira – Importação direta, exceto a indicada no código 6'],
            (object) ['id_nfci' => 2, 'nfci' => '2 – Estrangeira – Adquirida no mercado interno, exceto a indicada no código 7'],
            (object) ['id_nfci' => 3, 'nfci' => '3 – Nacional, mercadoria ou bem com Conteúdo de Importação superior a 40% (quarenta por cento) e inferior ou igual a 70% (setenta por cento)'],
            (object) ['id_nfci' => 4, 'nfci' => '4 – Nacional, cuja produção tenha sido feita em conformidade com os processos produtivos básicos de que tratam o Decreto-Lei nº 288/67, e as Leis nºs 8.248/91, 8.387/91, 10.176/01 e 11.484/07'],
            (object) ['id_nfci' => 5, 'nfci' => '5 – Nacional, mercadoria ou bem com Conteúdo de Importação inferior ou igual a 40% (quarenta por cento)'],
            (object) ['id_nfci' => 6, 'nfci' => '6 – Estrangeira – Importação direta, sem similar nacional, constante em lista de Resolução CAMEX e gás natural'],
            (object) ['id_nfci' => 7, 'nfci' => '7 – Estrangeira – Adquirida no mercado interno, sem similar nacional, constante em lista de Resolução CAMEX e gás natural'],
            (object) ['id_nfci' => 8, 'nfci' => '8 – Nacional – Mercadoria ou bem com Conteúdo de Importação superior a 70% (setenta por cento)'],
        ];
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
        $data['nfci']           = $this->nfci;
        $data['extipi']         = $this->extipi;
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
        $data['extipi']         = $this->extipi;
        $data['nfci']           = $this->nfci;
        $data['action']         = route('admin.produtos.update', $id);
        $data['method']         = 'PUT';
        return view('admin.pages.catalogo.produtos.create', $data);
    }

    public function store(StoreUpdateProduto $request)
    {
        //dd($request->quantidade);
        if (!isset($request->gtin))
            $request->merge(['gtin' => 'SEM GTIN']);

        if (!isset($request->cbenef))
            $request->merge(['cbenef' => 'SEM CBENEF']);

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

        if (!isset($request->cbenef))
            $request->merge(['cbenef' => 'SEM CBENEF']);

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
