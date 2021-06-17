<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateVenda;
use App\Models\Cliente;
use App\Models\ItemVenda;
use App\Models\Produto;
use App\Models\Nfe;
use Illuminate\Http\Request;
use App\Models\Venda;

class VendaController extends Controller
{
    private $repository, $clientes, $venda, $itensvenda, $produto, $nfe;

    public function __construct(Venda $repository, Cliente $clientes, Venda $venda, ItemVenda $itensvenda, Produto $produto, Nfe $nfe)
    {
        $this->repository = $repository;
        $this->clientes = $clientes;
        $this->venda = $venda;
        $this->itensvenda = $itensvenda;
        $this->produto = $produto;
    }

    public function index()
    {
        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title' => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.vendas.index'), 'title' => 'Vendas'];
        $data['vendas']         = $this->repository->with('cliente')->latest()->paginate(10);
        $data['title']          = 'Vendas';
        $data['create']         = route('admin.vendas.create');
        return view('admin.pages.vendas.vendas.index', $data);
    }

    public function search(Request $request)
    {
        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title' => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.vendas.index'), 'title' => 'Vendas'];
        $data['vendas']         = $this->repository->search($request->all())->paginate(10);
        $data['filters']        = $request->except('_token');
        $data['pesquisa']       = $request;
        $data['title']          = 'Vendas';
        $data['create']         = route('admin.vendas.create');
        return view('admin.pages.vendas.vendas.index', $data);
    }

    public function create()
    {
        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title'    => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.vendas.index'), 'title'     => 'Vendas'];
        $data['breadcrumb'][]   = ['link' => route('admin.vendas.create'), 'title'    => 'Nova Venda'];
        $data['title']          = 'Nova Venda';
        $data['action']         = route('admin.vendas.store');
        $data['clientes']       = $this->clientes->all();
        $data['method']         = 'POST';
        return view('admin.pages.vendas.vendas.create', $data);
    }

    public function show($id)
    {
        $venda = $this->repository->with('cliente')->where('id_venda', $id)->first();
        if (!$venda)
            return redirect()->back();

        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title'    => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.vendas.index'), 'title'     => 'Vendas'];
        $data['breadcrumb'][]   = ['link' => route('admin.vendas.show', $id), 'title'    => 'Venda ' . $venda->cliente->nome];
        $data['title']          = 'Venda ' . $venda->cliente->nome;
        $data['venda']        = $venda;
        $data['action']         = route('admin.vendas.delete', $id);
        return view('admin.pages.vendas.vendas.show', $data);
    }

    public function edit($id)
    {
        $venda = $this->repository->with('cliente')->where('id_venda', $id)->first();
        if (!$venda)
            return redirect()->back();

        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title'    => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.vendas.index'), 'title'     => 'Vendas'];
        $data['breadcrumb'][]   = ['link' => route('admin.clientes.edit', $id), 'title'    => 'Editar venda ' . $venda->cliente->nome];
        $data['title']          = 'Editar venda ' . $venda->cliente->nome;
        $data['venda']          = $venda;
        $data['action']         = route('admin.vendas.update', $id);
        $data['method']         = 'PUT';
        return view('admin.pages.vendas.vendas.create', $data);
    }

    public function detalhe($id)
    {
        $venda = $this->repository->with('cliente')->where('id_venda', $id)->first();
        if (!$venda)
            return redirect()->back();

        $itensvenda = $this->itensvenda->with('produto')->where(['id_venda' => $id, 'id_cliente' => $venda->cliente->id_cliente])->paginate(1000);

        $totalvenda = 0;
        foreach ($itensvenda as $i) {
            $totalvenda = $totalvenda + $i->valor;
        }

        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title'        => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.vendas.index'), 'title'           => 'Vendas'];
        $data['breadcrumb'][]   = ['link' => route('admin.vendas.detalhe', $id), 'title'    => 'Itens da venda'];
        $data['title']          = 'Itens da Venda ' . $venda->cliente->nome;
        $data['action']         = route('admin.vendas.insereItem');
        $data['venda']          = $venda;
        $data['totalvenda']     = $totalvenda;
        $data['itensvenda']     = $itensvenda;
        $data['method']         = 'POST';
        return view('admin.pages.vendas.vendas.detalhe', $data);
    }

    public function store(StoreUpdateVenda $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('admin.vendas.index');
    }

    public function update(StoreUpdateVenda $request, $id)
    {
        $venda = $this->repository->where('id_venda', $id)->first();
        if (!$venda)
            return redirect()->back();

        if ($request->finalizado == 'S')
            return redirect()->back()->withErrors('Não é permitido editar uma venda finalizada!')->withInput();

        $venda->where('id_venda', $id)->update($request->except(['_token', '_method', 'cliente']));
        return redirect()->route('admin.vendas.index');
    }

    public function pesquisa(Request $request)
    {
        $pesquisa = filter_var($request->pesquisa);
        $cliente = $this->clientes->select("id_cliente", "nome")->where("nome", "like", "%" . $pesquisa . "%")->get();
        echo ($cliente);
    }

    public function pesquisaProduto(Request $request)
    {
        $pesquisa = filter_var($request->pesquisa);
        $produto = $this->produto->select("id_produto", "preco", "produto")->where("produto", "like", "%" . $pesquisa . "%")->get();
        echo ($produto);
    }

    public function insereItem(Request $request)
    {
        $qtditem = $request->qtde;
        $produto = $this->produto->select('quantidade', 'preco')->where('id_produto', $request->id_produto)->first();
        $existitem = $this->itensvenda->where(['id_venda' => $request->id_venda, 'id_produto' => $request->id_produto])->get();
        if (!$request->id_produto)
            return redirect()->back()->withErrors('Selecione um produto')->withInput();

        if (tofloat($produto->quantidade) <= 0) //se o prod não tiver estoque
            return redirect()->back()->withErrors('O produto ' . $request->produto .  ' está com o estoque esgotado!')->withInput();

        if (count($existitem) > 0) { //se já estiver no carrinho e, a nova adição mais o que já exite for maior que o estoque
            $qtd = $this->itensvenda->select('qtde')->where(['id_produto' => $request->id_produto, 'id_venda' => $request->id_venda])->get();
            $qtd = tofloat($qtd) + tofloat($request->qtde);
            if ($qtd > tofloat($produto->quantidade))
                return redirect()->back()->withErrors('O produto ' . $request->produto .  ' possui estoque de ' . tofloat($produto->quantidade))->withInput();
            else
                $request->merge(['qtde' => $qtd, 'valor' => floatval($produto->preco) * $qtd]);

            $this->itensvenda->where(['id_produto' => $request->id_produto, 'id_venda' => $request->id_venda])->update(['qtde' => $request->qtde, 'valor' => $request->valor]);
        } else {
            if (tofloat($qtditem) > tofloat($produto->quantidade))
                return redirect()->back()->withErrors('O produto ' . $request->produto .  ' possui estoque de ' . tofloat($produto->quantide))->withInput();

            $this->itensvenda->create($request->all());
        }
        return redirect()->route('admin.vendas.detalhe', $request->id_venda);
    }

    public function deleteitem($iditem, $idvenda)
    {
        $item = $this->itensvenda->where(['id_item_venda' => $iditem, 'id_venda' => $idvenda])->first();
        if (!$item)
            return redirect()->back();

        $this->itensvenda->where('id_item_venda', $iditem)->delete();
        return redirect()->route('admin.vendas.detalhe', $idvenda);
    }

    public function finalizavenda(Request $request, $idvenda)
    {
        $venda = $this->repository->with('cliente')->where('id_venda', $idvenda)->first();
        if (!$venda)
            return redirect()->back();

        if ($request->total <= 0)
            return redirect()->back()->withErrors('insira produtos na venda!')->withInput();

        $itens = $this->itensvenda->where('id_venda', $idvenda)->get();
        foreach ($itens as $i) {
            $saldoatual = 0;
            $novosaldo = 0;
            $saldoatual = $this->produto->select('quantidade')->where('id_produto', $i->id_produto)->get();
            $novosaldo = tofloat($saldoatual) -  tofloat($i->qtde);
            $this->produto->where('id_produto', $i->id_produto)->update(['quantidade' => $novosaldo]);
        }

        $venda->where('id_venda', $idvenda)->update($request->except(['_token', '_method']));
        return redirect()->route('admin.vendas.index');
    }

    public function delete($id)
    {
        $venda = $this->repository->where('id_venda', $id)->first();
        if (!$venda)
            return redirect()->back();

        $itensvenda = $this->itensvenda->where('id_venda', $id)->get();
        if ($itensvenda){
            foreach($itensvenda as $i){
                $produto = $this->produto->where('id_produto', $i->id_produto)->first();
                $i->qtde = tofloat($i->qtde) + tofloat($produto->quantidade);
                $this->produto->where('id_produto', $i->id_produto)->update(['quantidade' => $i->qtde]);
                $this->itensvenda->where(['id_venda' => $id, 'id_produto' => $i->id_produto])->delete();
            }
        }
        $venda->where('id_venda', $id)->delete();
        return redirect()->route('admin.vendas.index');
    }
}
