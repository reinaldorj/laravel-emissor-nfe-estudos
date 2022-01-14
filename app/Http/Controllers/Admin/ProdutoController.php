<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\supports\widgets\form\Combo;
use App\Helpers\supports\widgets\form\Date;
use App\Helpers\supports\widgets\form\Entry;
use App\Helpers\supports\widgets\form\Form;
use App\Helpers\supports\widgets\form\wrapper\FormWrapper;
use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Unidade;
use App\Http\Requests\StoreUpdateProduto;
use App\Models\cfop;
use App\Models\UnidadeMedida;
use App\Models\UnidadePeso;
use App\Services\ProdutoService;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    private $repository, $unidades, $cfops, $undpeso, $undmedida, $extipi, $nfci;
    private $produtoService;

    public function __construct(
        Produto $produto, 
        Unidade $unidade, 
        cfop $cfops, 
        UnidadeMedida $undmedida, 
        UnidadePeso $undpeso,
        ProdutoService $produtoService
        )
    {
        $this->produtoService = $produtoService;
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
        $data['produtos']       = $this->produtoService->getList();
        $data['title']          = 'Produtos';
        $data['create']         = route('admin.produtos.create');
        return view('admin.pages.catalogo.produtos.index', $data);
    }

    public function search(Request $request)
    {
        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title' => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.produtos.index'), 'title' => 'Produtos'];
        $data['produtos']       = $this->produtoService->search($request->filter);
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
        // $data['form']           = $this->form();
        $data['action']         = route('admin.produtos.store');
        $data['method']         = 'POST';
        return view('admin.pages.catalogo.produtos.create', $data);
    }

    public function edit($id)
    {
        $produto = $this->produtoService->get($id);
        if (!$produto) return redirect()->back();

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
        $this->produtoService->store($request->all());
        return redirect()->route('admin.produtos.index');
    }

    public function update(StoreUpdateProduto $request, $id)
    {
        $produto = $this->produtoService->get($id);
        if (!$produto)
            return redirect()->back();

        $this->produtoService->update($request->except(['_token', '_method']), $id);
        return redirect()->route('admin.produtos.index');
    }

    public function show($id)
    {
        $produto = $this->produtoService->get($id);
        if (!$produto) return redirect()->back();

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
        $produto = $this->produtoService->get($id);
        if (!$produto) return redirect()->back();

        $this->produtoService->destroy($id);
        return redirect()->route('admin.produtos.index');
    }

    private function form($obj = null)
    {
        $form = new FormWrapper(new Form('teste'));
        $form->setActionInBottom(true);
        $name = new Entry('name');
        $lastname = new Entry('lastname');
        $date = new Date('date');

        $sexo = new Combo('sexo');
        $sexo->addItems(['M'=> 'masculino', 'F' => 'Feminino']);

        $form->addField($name, ['label' => 'Nome', 'css' => 'col-md-3']);
        $form->addField($lastname, ['label' => 'Sobre nome', 'css' => 'col-md-3']);
        $form->addField($date, ['label' => 'Data de nascimento']);
        $form->addField($sexo, ['label' => 'Sexo']);

        $form->addAction('Salvar', (object)['submit' => true, 'css' => 'btn btn-success mr-2', 'route' => '#']);
        $form->addAction('Cancelar', (object)['submit' => false, 'css' => 'btn btn-dark', 'route' => '#']);

        $form->setData($obj);

        return $form->getForm();
    }
}
