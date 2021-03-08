<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nfe;
use App\Models\Venda;
use App\Models\Emitente;
use App\Models\Configuracao;
use App\Models\Nfeemitente;
use App\Models\Nfedestinatario;
use App\Models\Nfeitem;
use App\Models\Estado;
use Illuminate\Http\Request;
use stdClass;

class NotaFiscalController extends Controller
{
    private $repository, $venda, $emitente, $configuracao, $estado, $nfeemitente, $nfedestinatario, $nfeitem;

    public function __construct(Nfe $repository, Venda $venda, Emitente $emitente, Configuracao $configuracao, Estado $estado, Nfeemitente $nfeemitente, Nfedestinatario $nfedestinatario, Nfeitem $nfeitem)
    {
        $this->repository       = $repository;
        $this->venda            = $venda;
        $this->emitente         = $emitente;
        $this->configuracao     = $configuracao;
        $this->estado           = $estado;
        $this->nfeemitente      = $nfeemitente;
        $this->nfedestinatario  = $nfedestinatario;
        $this->nfeitem          = $nfeitem;
    }

    public function index()
    {
        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title' => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.notafiscal.index'), 'title' => 'Notas'];
        $data['notas']          = $this->repository->getnfes();
        $data['title']          = 'Notas';
        $data['create']         = route('admin.notafiscal.create');
        return view('admin.pages.notas.nota_fiscal.index', $data);
    }

    public function search(Request $request)
    {
        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title' => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.notafiscal.index'), 'title' => 'Notas'];
        $data['notas']          = $this->repository->search($request->filter);
        $data['filters']        = $request->except('_token');
        $data['pesquisa']       = $request->filter;
        $data['title']          = 'Notas';
        $data['create']         = route('admin.notafiscal.create');
        return view('admin.pages.notas.nota_fiscal.index', $data);
    }

    public function create()
    {
        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title'    => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.notafiscal.index'), 'title'     => 'Notas'];
        $data['breadcrumb'][]   = ['link' => route('admin.notafiscal.create'), 'title'    => 'Emitir nota'];
        $data['title']          = 'Emitir nota';
        $data['action']         = route('admin.notafiscal.store');
        $data['method']         = 'POST';
        return view('admin.pages.notas.nota_fiscal.create', $data);
    }

    public function edit($id)
    {
        $nota = $this->repository->where('id_nfe', $id)->first();
        if (!$nota)
            return redirect()->back();

        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title'    => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.notafiscal.index'), 'title'     => 'Notas'];
        $data['breadcrumb'][]   = ['link' => route('admin.notafiscal.edit', $id), 'title'    => 'Editar nota ' . $nota->em_xNome ];
        $data['title']          = 'Editar nota ' . $nota->em_xNome ;
        $data['nota']           = $nota;
        $data['action']         = route('admin.notafiscal.update', $id);
        $data['method']         = 'PUT';
        return view('admin.pages.notas.nota_fiscal.create', $data);
    }

    public function show($id)
    {
        $nota = $this->repository->where('id_nfe', $id)->first();
        if (!$nota)
            return redirect()->back();

        $data['breadcrumb'][]   = ['link' => route('admin.principal.index'), 'title'    => 'Dashboard'];
        $data['breadcrumb'][]   = ['link' => route('admin.notafiscal.index'), 'title'     => 'Empresas'];
        $data['breadcrumb'][]   = ['link' => route('admin.notafiscal.show', $id), 'title'    => 'Empresa ' . $nota->em_xNome];
        $data['title']          = 'Empresa ' . $nota->em_xNome;
        $data['nota']        = $nota;
        $data['action']         = route('admin.notafiscal.delete', $id);
        return view('admin.pages.notas.nota_fiscal.show', $data);
    }

    public function store(Request $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('admin.nota_fiscal.index');
    }

    public function update(Request $request, $id)
    {
        $nota = $this->repository->where('id_nfe', $id);
        if (!$nota)
            return redirect()->back();

        $nota->update($request->except(['_token', '_method']));
        return redirect()->route('admin.nota_fiscal.index');
    }

    public function delete($id)
    {
        $nota = $this->repository->where('id_nfe', $id)->first();
        if (!$nota)
            return redirect()->back();

        $nota->where('id_nfe', $id)->delete();
        return redirect()->route('admin.nota_fiscal.index');
    }

    public function insere($idvenda)
    {
        $configuracao   = $this->configuracao->with('emitente')->first();
        if (!$configuracao)
            return redirect()->route('admin.configuracoes.index')->withErrors('É necessário efetuar a configuração padrão da nota');

        $estadopadrao   = $this->estado->where('uf_estado', $configuracao->emitente->uf)->first();
        $venda          = $this->venda->with('cliente')->where('id_venda', $idvenda)->first();
        $nota           = $this->repository->where('id_venda', $idvenda)->first();
        $itensvenda     = $this->venda->getitens($idvenda);

        if ($nota)
            return redirect()->route('admin.notafiscal.index')->withErrors('nota já emitida!');


        $data['id_venda']               = $idvenda;
        $data['cUF']                    = $estadopadrao->codigo_estado;
        $data['natOp']                  = $configuracao->natureza_padrao;
        $data['indPag']                 = 0;
        $data['modelo']                 = 55;
        $data['serie']                  = $configuracao->nfe_serie;
        $data['nNF']                    = $configuracao->ultimanfe + 1;
        $data['cNF']                    = rand($data['nNF'], 99999999);
        $data['dhEmi']                  = hoje() . 'T' . agora() . '-03:00';
        $data['dhSaiEnt']               = null;
        $data['tpNF']                   = $configuracao->tipo_nota_padrao;

        if ($configuracao->emitente->uf == $venda->cliente->uf) {
            $data['idDest']             = 1; //dentro do estado
        } else {
            $data['idDest']             = 2; //fora do estado
        }

        $data['cMunFG']                 = $configuracao->emitente->ibge;
        $data['tpImp']                  = 1;
        $data['tpEmis']                 = 1;
        $data['tpAmb']                  = $configuracao->nfe_ambiente;
        $data['finNFe']                 = 1;
        $data['indFinal']               = $configuracao->indFinal;
        $data['indPres']                = 2;
        $data['procEmi']                = 0;
        $data['verProc']                = $configuracao->nfe_versao;
        $data['dhCont']                 = null;
        $data['xJust']                  = null;
        $data['id_status']              = 2;


        $id_nfe = $this->repository->create($data)->id;

        $dataemitente['id_nfe']         = $id_nfe;
        $dataemitente['em_xNome']       = slug($configuracao->emitente->razao_social);
        $dataemitente['em_xFant']       = slug($configuracao->emitente->nome_fantasia);
        $dataemitente['em_IE']          = $configuracao->emitente->ie;
        $dataemitente['em_IEST']        = $configuracao->emitente->iest;
        $dataemitente['em_IM']          = $configuracao->emitente->im;
        $dataemitente['em_CNAE']        = $configuracao->emitente->cnae;
        $dataemitente['em_CRT']         = $configuracao->emitente->regime_tributario;
        $dataemitente['em_CNPJ']        = tira_mascara($configuracao->emitente->cnpj);
        $dataemitente['em_xLgr']        = slug($configuracao->emitente->logradouro);
        $dataemitente['em_nro']         = $configuracao->emitente->numero;
        $dataemitente['em_xCpl']        = slug($configuracao->emitente->complemento);
        $dataemitente['em_xBairro']     = slug($configuracao->emitente->bairro);
        $dataemitente['em_cMun']        = $configuracao->emitente->ibge;
        $dataemitente['em_xMun']        = slug($configuracao->emitente->cidade);
        $dataemitente['em_UF']          = $configuracao->emitente->uf;
        $dataemitente['em_CEP']         = slug($configuracao->emitente->cep);
        $dataemitente['em_cPais']       = '1058';
        $dataemitente['em_xPais']       = 'Brasil';
        $dataemitente['em_fone']        = $configuracao->emitente->fone;
        $dataemitente['em_EMAIL']       = $configuracao->emitente->email;
        //$dataemitente['em_SUFRAMA']     = $configuracao->emitente->suframa;

        $id_nfeemitente = $this->nfeemitente->create($dataemitente)->id;
        
        $datadestinatario['id_nfe']             = $id_nfe;
        $datadestinatario['dest_xNome']         = slug($venda->cliente->nome);
        $datadestinatario['dest_IE']            = $venda->cliente->ie;
        $datadestinatario['dest_indIEDest']     = $venda->cliente->indIEDest;
        $datadestinatario['dest_ISUF']          = $venda->cliente->suframa;
        $datadestinatario['dest_IM']            = $venda->cliente->im;
        $datadestinatario['dest_email']         = $venda->cliente->email;
        $datadestinatario['dest_CNPJ']          = tira_mascara($venda->cliente->cnpj);
        $datadestinatario['dest_CPF']           = tira_mascara($venda->cliente->cpf);
        $datadestinatario['dest_idEstrangeiro'] = $venda->cliente->cod_estrangeiro;
        $datadestinatario['dest_xLgr']          = slug($venda->cliente->logradouro);
        $datadestinatario['dest_nro']           = $venda->cliente->numero;
        $datadestinatario['dest_xCpl']          = slug($venda->cliente->complemento);
        $datadestinatario['dest_xBairro']       = slug($venda->cliente->bairro);
        $datadestinatario['dest_cMun']          = $venda->cliente->ibge;
        $datadestinatario['dest_xMun']          = slug($venda->cliente->cidade);
        $datadestinatario['dest_UF']            = $venda->cliente->uf;
        $datadestinatario['dest_CEP']           = tira_mascara($venda->cliente->cep);
        $datadestinatario['dest_cPais']         = '1058';
        $datadestinatario['dest_xPais']         = 'Brasil';
        $datadestinatario['dest_fone']          = $venda->cliente->fone;

        $idnfe_destinatario = $this->nfedestinatario->create($datadestinatario)->id;

        $j = 0;
        foreach($itensvenda as $item){
            $j++;
            $dataitemvenda['id_venda']          = $idvenda;
            $dataitemvenda['id_produto']        = $item->id_produto;
            $dataitemvenda['id_nfe']            = $id_nfe;
            $dataitemvenda['numero_item']       = $j;
            $dataitemvenda['cProd']             = $item->id_produto;
            $dataitemvenda['cEAN']              = $item->gtin;
            $dataitemvenda['xProd']             = slug($item->produto);
            $dataitemvenda['NCM']               = $item->ncm;
            $dataitemvenda['cBenef']            = $item->cbenef;
            $dataitemvenda['NVE']               = null;
            $dataitemvenda['EXTIPI']            = $item->extipi;
            $dataitemvenda['CFOP']              = $item->cfop;
            $dataitemvenda['uCom']              = $item->abrev;
            $dataitemvenda['qCom']              = $item->qtde;
            $dataitemvenda['vUnCom']            = $item->preco;
            $dataitemvenda['vProd']             = $item->qtde * $item->preco;
            $dataitemvenda['cEANTrib']          = $item->gtin;
            $dataitemvenda['uTrib']             = $item->abrev;
            $dataitemvenda['qTrib']             = $item->qtde;
            $dataitemvenda['vUnTrib']           = $item->preco;
            $dataitemvenda['vFrete']            = null;
            $dataitemvenda['vSeg']              = null;
            $dataitemvenda['vDesc']             = null;
            $dataitemvenda['vOutro']            = null;
            $dataitemvenda['indTot']            = 1;
            $dataitemvenda['xPed']              = $id_nfe;
            $dataitemvenda['nItemPed']          = $j;
            $dataitemvenda['nFCI']              = $item->nfci;

            $this->nfeitem->create($dataitemvenda);
        }

        return $this->index();
    }
}
