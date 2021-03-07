<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nfe;

class NotaController extends Controller
{
    private $repository;

    public function __construct(Nfe $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title' => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.notas.index'), 'title' => 'Notas'];
        $data['notas']          = $this->repository->oldest()->paginate(10);
        $data['title']          = 'Notas';
        $data['create']         = route('admin.notas.create');
        return view('admin.pages.notas.notas.index', $data);
    }

    public function search(Request $request)
    {
        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title' => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.notas.index'), 'title' => 'Notas'];
        $data['notas']          = $this->repository->search($request->filter);
        $data['filters']        = $request->except('_token');
        $data['pesquisa']       = $request->filter;
        $data['title']          = 'Notas';
        $data['create']         = route('admin.notas.create');
        return view('admin.pages.notas.notas.index', $data);
    }

    public function create()
    {
        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title'    => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.notas.index'), 'title'     => 'Notas'];
        $data['breadcrumb'][]   = ['link' => route('admin.notas.create'), 'title'    => 'Emitir nota'];
        $data['title']          = 'Emitir nota';
        $data['action']         = route('admin.notas.store');
        $data['method']         = 'POST';
        return view('admin.pages.notas.notas.create', $data);
    }

    public function edit($id)
    {
        $nota = $this->repository->where('id_nfe', $id)->first();
        if (!$nota)
            return redirect()->back();

        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title'    => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.notas.index'), 'title'     => 'Notas'];
        $data['breadcrumb'][]   = ['link' => route('admin.notas.edit', $id), 'title'    => 'Editar nota ' . $nota->em_xNome ];
        $data['title']          = 'Editar nota ' . $nota->em_xNome ;
        $data['nota']           = $nota;
        $data['action']         = route('admin.notas.update', $id);
        $data['method']         = 'PUT';
        return view('admin.pages.notas.notas.create', $data);
    }

    public function show($id)
    {
        $nota = $this->repository->where('id_nfe', $id)->first();
        if (!$nota)
            return redirect()->back();

        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title'    => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.empresas.index'), 'title'     => 'Empresas'];
        $data['breadcrumb'][]   = ['link' => route('admin.empresas.show', $id), 'title'    => 'Empresa ' . $nota->em_xNome];
        $data['title']          = 'Empresa ' . $nota->em_xNome;
        $data['nota']        = $nota;
        $data['action']         = route('admin.empresas.delete', $id);
        return view('admin.pages.notas.notas.show', $data);
    }

    public function store(Request $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('admin.notas.index');
    }

    public function update(Request $request, $id)
    {
        $nota = $this->repository->where('id_nfe', $id);
        if (!$nota)
            return redirect()->back();

        $nota->update($request->except(['_token', '_method']));
        return redirect()->route('admin.notas.index');
    }

    public function delete($id)
    {
        $nota = $this->repository->where('id_nfe', $id)->first();
        if (!$nota)
            return redirect()->back();

        $nota->where('id_nfe', $id)->delete();
        return redirect()->route('admin.notas.index');
    }
}
