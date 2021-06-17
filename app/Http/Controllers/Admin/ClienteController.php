<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Http\Requests\StoreUpdateClientes;
use App\Http\Controllers\Controller;

class ClienteController extends Controller
{
    private $repository;
    private $indIEDest;

    public function __construct(Cliente $repository)
    {
        $this->repository = $repository;
        $this->indIEDest = (object)[
            (object) ['id' => 1, 'tipo' => '1 - Contribuinte do ICMS'],
            (object) ['id' => 2, 'tipo' => '2 - Contribuinte isento'],
            (object) ['id' => 9, 'tipo' => '9 - Não Contribuinte']
        ];
    }

    public function index()
    {
        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title' => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.clientes.index'), 'title' => 'Clientes'];
        $data['clientes']       = $this->repository->oldest()->paginate(10);
        $data['title']          = 'Clientes';
        $data['create']         = route('admin.clientes.create');
        return view('admin.pages.clientes.clientes.index', $data);
    }

    public function search(Request $request)
    {
        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title' => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.clientes.index'), 'title' => 'Clientes'];
        $data['clientes']       = $this->repository->search($request->filter);
        $data['filters']        = $request->except('_token');
        $data['pesquisa']       = $request->filter;
        $data['title']          = 'Clientes';
        $data['create']         = route('admin.clientes.create');
        return view('admin.pages.clientes.clientes.index', $data);
    }

    public function create()
    {
        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title'    => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.clientes.index'), 'title'     => 'Clientes'];
        $data['breadcrumb'][]   = ['link' => route('admin.clientes.create'), 'title'    => 'Novo cliente'];
        $data['title']          = 'Novo cliente';
        $data['action']         = route('admin.clientes.store');
        $data['indiedest']      = $this->indIEDest;
        $data['method']         = 'POST';
        return view('admin.pages.clientes.clientes.create', $data);
    }

    public function edit($id)
    {
        $cliente = $this->repository->where('id_cliente', $id)->first();
        if (!$cliente)
            return redirect()->back();

        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title'    => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.clientes.index'), 'title'     => 'Clientes'];
        $data['breadcrumb'][]   = ['link' => route('admin.clientes.edit', $id), 'title'    => 'Editar cliente ' . $cliente->nome];
        $data['title']          = 'Editar cliente ' . $cliente->nome;
        $data['cliente']        = $cliente;
        $data['action']         = route('admin.clientes.update', $id);
        $data['indiedest']      = $this->indIEDest;
        $data['method']         = 'PUT';
        return view('admin.pages.clientes.clientes.create', $data);
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

    public function store(StoreUpdateClientes $request)
    {
        if (isset($request->cnpj)) {
            $cnpjvalido = validaCNPJ($request->cnpj);
            if (!$cnpjvalido)
                return redirect()->back()->withErrors('Informe um CNPJ válido!')->withInput();
        }

        if (isset($request->cpf)) {
            $cpfvalido = validaCPF($request->cpf);
            if (!$cpfvalido)
                return redirect()->back()->withErrors('Informe um CPF válido!')->withInput();
        }

        if (isset($request->ie)) {
            if ($request->indIEDest != 1)
                return redirect()->back()->withErrors('O campo IE não pode conter valores!')->withInput();
        }

        if (isset($request->indIEDest)) {
            if ($request->indIEDest == 1 && !isset($request->ie))
                return redirect()->back()->withErrors('É obrigatório digitar a inscrição estadual!')->withInput();
        }

        $this->repository->create($request->all());
        return redirect()->route('admin.clientes.index');
    }

    public function update(StoreUpdateClientes $request, $id)
    {
        if (isset($request->cnpj)) {
            $cnpjvalido = validaCNPJ($request->cnpj);
            if (!$cnpjvalido)
                return redirect()->back()->withErrors('Informe um CNPJ válido!');
        }

        if (isset($request->cpf)) {
            $cpfvalido = validaCPF($request->cpf);
            if (!$cpfvalido)
                return redirect()->back()->withErrors('Informe um CPF válido!');
        }

        if (isset($request->ie)) {
            if ($request->indIEDest != 1)
                return redirect()->back()->withErrors('O campo IE não pode conter valores!')->withInput();
        }

        if (isset($request->indIEDest)) {
            if ($request->indIEDest == 1 && !isset($request->ie))
                return redirect()->back()->withErrors('É obrigatório digitar a inscrição estadual!')->withInput();
        }

        $cliente = $this->repository->where('id_cliente', $id);
        if (!$cliente)
            return redirect()->back();

        $cliente->update($request->except(['_token', '_method']));
        return redirect()->route('admin.clientes.index');
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
