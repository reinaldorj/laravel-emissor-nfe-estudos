<?php

namespace App\Http\Controllers\Admin\Nfe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nfe;
use App\Models\Nfeemitente;
use App\Models\Nfedestinatario;
use App\Models\Nfeitem;
use App\Models\Configuracao;
use Exception;
use NFePHP\NFe\Make;
use NFePHP\Common\Certificate;
use NFePHP\NFe\Tools;

class NfeController extends Controller
{
    private $notafiscal, $nfe, $nfeemitente, $nfedestinatario, $nfeitens, $configuracao;

    public function __construct(Nfe $notafiscal, Nfeemitente $nfeemitente, Nfedestinatario $nfedestinatario, Nfeitem $nfeitens, Configuracao $configuracao)
    {
        $this->notafiscal       = $notafiscal;
        $this->nfeemitente      = $nfeemitente;
        $this->nfedestinatario  = $nfedestinatario;
        $this->nfeitens         = $nfeitens;
        $this->configuracao     = $configuracao;
        $this->nfe              = new Make();
    }

    public function gerarnfe($idnota)
    {
        $nota               = $this->notafiscal->where('id_nfe', $idnota)->first();
        $notaemitente       = $this->nfeemitente->where('id_nfe', $idnota)->first();
        $notadestinatario   = $this->nfedestinatario->where('id_nfe', $idnota)->first();
        $notaitens          = $this->nfeitens->where('id_nfe', $idnota)->get();
        //$nfe = new Make();
        $data = (object) [
            'versao'    => '4.00',
            'Id'        => '',
            'pk_nItem' => null
        ];
        $this->nfe->taginfNFe($data);

        //identificacao
        $data = (object)[
            'cUF'       => $nota->cUF,
            'cNF'       => $nota->cNF,
            'natOp'     => $nota->natOp,
            'indPag'    => 0,
            'mod'       => $nota->modelo,
            'serie'     => $nota->serie,
            'nNF'       => $nota->nNF,
            'dhEmi'     => $nota->dhEmi,
            'dhSaiEnt'  => $nota->dhSaiEnt,
            'tpNF'      => $nota->tpNF,
            'idDest'    => $nota->idDest,
            'cMunFG'    => $nota->cMunFG,
            'tpImp'     => $nota->tpImp,
            'tpEmis'    => $nota->tpEmis,
            'cDV'       => $nota->cDV,
            'tpAmb'     => $nota->tpAmb,
            'finNFe'    => $nota->finNFe,
            'indFinal'  => $nota->indFinal,
            'indPres'   => $nota->indPres,
            'procEmi'   => $nota->procEmi,
            'verProc'   => $nota->verProc,
            'dhCont'    => $nota->dhCont,
            'xJust'     => $nota->xJust
        ];
        $this->nfe->tagide($data);

        //dd($data);

        //emitente
        $data = (object)[
            'xNome'     => strtoupper($notaemitente->em_xNome),
            'xFant'     => strtoupper($notaemitente->em_xFant),
            'IE'        => $notaemitente->em_IE,
            'IEST'      => $notaemitente->em_IEST,
            'IM'        => $notaemitente->em_IM,
            'CNAE'      => $notaemitente->em_CNAE,
            'CRT'       => $notaemitente->em_CRT,
            'CNPJ'      => ($notaemitente->em_CNPJ) ? $notaemitente->em_CNPJ : null,
            'CPF'       => ($notaemitente->em_CPF) ? $notaemitente->em_CPF : null
        ];
        $this->nfe->tagemit($data);

        $data = (object) [
            'xLgr'      => $notaemitente->em_xLgr,
            'nro'       => $notaemitente->em_nro,
            'xCpl'      => $notaemitente->em_xCpl,
            'xBairro'   => $notaemitente->em_xBairro,
            'cMun'      => $notaemitente->em_cMun,
            'xMun'      => $notaemitente->em_xMun,
            'UF'        => $notaemitente->em_UF,
            'CEP'       => tira_mascara($notaemitente->em_CEP),
            'cPais'     => $notaemitente->em_cPais,
            'xPais'     => $notaemitente->em_xPais,
            'fone'      => tira_mascara($notaemitente->em_fone)
        ];
        $this->nfe->tagenderEmit($data);

        //destinatario
        $data = (object) [
            'xNome'         => strtoupper($notadestinatario->dest_xNome),
            'indIEDest'     => $notadestinatario->dest_indIEDest,
            'IE'            => $notadestinatario->dest_IE,
            'ISUF'          => $notadestinatario->dest_ISUF,
            'IM'            => $notadestinatario->dest_IM,
            'email'         => $notadestinatario->dest_email,
            'CNPJ'          => ($notadestinatario->dest_CNPJ) ? tira_mascara($notadestinatario->dest_CNPJ) : null,
            'CPF'           => ($notadestinatario->dest_CPF) ? tira_mascara($notadestinatario->dest_CPF) : null,
            'idEstrangeiro' => $notadestinatario->dest_idEstrangeiro
        ];
        $this->nfe->tagdest($data);

        //end destinatario
        $data = (object) [
            'xLgr'      => $notadestinatario->dest_xLgr,
            'nro'       => $notadestinatario->dest_nro,
            'xCpl'      => $notadestinatario->dest_xCpl,
            'xBairro'   => $notadestinatario->dest_xBairro,
            'cMun'      => $notadestinatario->dest_cMun,
            'xMun'      => $notadestinatario->dest_xMun,
            'UF'        => $notadestinatario->dest_UF,
            'CEP'       => tira_mascara($notadestinatario->dest_CEP),
            'cPais'     => $notadestinatario->dest_cPais,
            'xPais'     => $notadestinatario->dest_xPais,
            'dest_fone' => tira_mascara($notadestinatario->dest_fone)
        ];
        $this->nfe->tagenderDest($data);

        //itensnfe
        $count = 0;
        foreach ($notaitens as $item) {
            $count++;
            $data = (object) [
                'item'      => $count,
                'cProd'     => $item->cProd,
                'cEAN'      => $item->cEAN,
                'xProd'     => $item->xProd,
                'NCM'       => $item->NCM,
                'cBenef'    => $item->cBenef,
                'EXTIPI'    => $item->EXTIPI,
                'CFOP'      => $item->CFOP,
                'uCom'      => $item->uCom,
                'qCom'      => $item->qCom,
                'vUnCom'    => $item->vUnCom,
                'vProd'     => $item->vProd,
                'cEANTrib'  => $item->cEANTrib,
                'uTrib'     => $item->uTrib,
                'qTrib'     => $item->qTrib,
                'vUnTrib'   => $item->vUnTrib,
                'vFrete'    => $item->vFrete,
                'vSeg'      => $item->vSeg,
                'vDesc'     => $item->vDesc,
                'vOutro'    => $item->vOutro,
                'indTot'    => $item->indTot,
                'xPed'      => $item->xPed,
                'nItemPed'  => $item->nItemPed,
                'nFCI'      => $item->nFCI
            ];
            $this->nfe->tagprod($data);

            /**
             * CSOSN
             * 101 - Tributada pelo Simples Nacional com permissão de crédito de ICMS
             * 102 - Tributada pelo Simples Nacional sem permissão de crédito
             * 103 - Isenção de ICMS no Simples Nacional na faixa de receita bruta
             * 201 - Tributada pelo Simples Nacional com permissão de crédito e cobrança do ICMS por ST
             * 202 - Tributada pelo Simples Nacional sem permissão de crédito e com cobrança do ICMS por ST
             * 203 - Isenção do ICMS no Simples Nacional para faixa de receita bruta e cobrança de ICMS por ST
             * 300 - Imune de ICMS
             * 400 - Não tributada pelo Simples Nacional
             * 500 - ICMS cobrado anteriormente por ST ou por antecipação
             * 900 - Outros (operações que não se enquadram nos códigos anteriores)
             */
            $data = (object) [
                'item'              => $count,
                'orig'              => 0,
                'CSOSN'             => 103,
                'pCredSN'           => null,
                'vCredICMSSN'       => null,
                'modBCST'           => null,
                'pMVAST'            => null,
                'pRedBCST'          => null,
                'vBCST'             => null,
                'pICMSST'           => null,
                'vICMSST'           => null,
                'vBCFCPST'          => null,
                'pFCPST'            => null,
                'vFCPST'            => null,
                'vBCSTRet'          => null,
                'pST'               => null,
                'vICMSSTRet'        => null,
                'vBCFCPSTRet'       => null,
                'pFCPSTRet'         => null,
                'vFCPSTRet'         => null,
                'modBC'             => null,
                'vBC'               => null,
                'pRedBC'            => null,
                'pICMS'             => null,
                'vICMS'             => null,
                'pRedBCEfet'        => null,
                'vBCEfet'           => null,
                'pICMSEfet'         => null,
                'vICMSEfet'         => null,
                'vICMSSubstituto'   => null,
            ];
            $this->nfe->tagICMSSN($data);

            //Nacional, mercadoria ou bem com Conteúdo de Importação superior a 40% (quarenta por cento) e inferior ou igual a 70% (setenta por cento)
            $data = (object) [
                'item'      => $count,
                'CST'       => '07',
                'vBC'       => null,
                'pPIS'      => null,
                'vPIS'      => null,
                'qBCProd'   => null,
                'vAliqProd' => null,
            ];
            $this->nfe->tagPIS($data);

            //cofins
            $data = (object)[
                'item'      => $count,
                'CST'       => '07',
                'vBC'       => null,
                'pCOFINS'   => null,
                'vCOFINS'   => null,
                'qBCProd'   => null,
                'vAliqProd' => null,
            ];
            $this->nfe->tagCOFINS($data);
            /* simples nacional
            $std = new stdClass();
            $std->item = 1; //item da NFe
            $std->clEnq = null;
            $std->CNPJProd = null;
            $std->cSelo = null;
            $std->qSelo = null;
            $std->cEnq = '999';
            $std->CST = '50';
            $std->vIPI = 150.00;
            $std->vBC = 1000.00;
            $std->pIPI = 15.00;
            $std->qUnid = null;
            $std->vUnid = null;

            $nfe->tagIPI($std);
            */
            $data = (object) [
                'item'      => $count,
                'vTotTrib ' => $nota->vTotTrib
            ];
            $this->nfe->tagimposto($data);
        }

        //totais nota
        $data = (object) [
            'vBC'           => $nota->vBC,
            'vICMS'         => $nota->vICMS,
            'vICMSDeson'    => $nota->vICMSDeson,
            'vFCP'          => $nota->vFCP,
            'vBCST'         => $nota->vBCST,
            'vST'           => $nota->vST,
            'vFCPST'        => $nota->vFCPST,
            'vFCPSTRet'     => $nota->vFCPSTRet,
            'vProd'         => $nota->vProd,
            'vFrete'        => $nota->vFrete,
            'vSeg'          => $nota->vSeg,
            'vDesc'         => $nota->vDesc,
            'vII'           => $nota->vII,
            'vIPI'          => $nota->vIPI,
            'vIPIDevol'     => $nota->vIPIDevol,
            'vPIS'          => $nota->vPIS,
            'vCOFINS'       => $nota->vCOFINS,
            'vOutro'        => $nota->vOutro,
            'vNF'           => $nota->vNF,
            'vTotTrib'      => $nota->vTotTrib,
        ];
        $this->nfe->tagICMSTot($data);

        //tranporte
        $data = (object) [
            'modFrete' =>  0
        ];
        $this->nfe->tagtransp($data);

        //dados fatura
        $data = (object) [
            'nFat' => $nota->id_nfe,
            'vOrig' => $nota->vOrig,
            'vDesc' => $nota->vDesc,
            'vLiq' => $nota->vLiq,
        ];
        $this->nfe->tagfat($data);

        //pagamento
        $data = (object) [
            'vTroco' => null
        ];
        $this->nfe->tagpag($data);

        $data = (object) [
            'tPag'          => '01',
            'vPag'          => ($nota->vOrig) ? $nota->vOrig : 0,
            'CNPJ'          => null,
            'tBand'         => null,
            'cAut'          => null,
            'tpIntegra'     => null, //incluso na NT 2015/002
            'indPag'        => '0', //0= Pagamento à Vista 1= Pagamento à Prazo
        ];
        $this->nfe->tagdetPag($data);

        try {
            $result = $this->nfe->montaNFe();
            if ($result) {
                $xml            = $this->nfe->getXML();
                $chave          = $this->nfe->getChave();
                $nomexml        = $chave . '-nfe.xml';
                $pastaambiente  = ($nota->tpAmb == 1) ? 'producao' : 'homologacao';
                $path           = base_path() . '\notas\\' . $pastaambiente . '\temporarias\\' . $nomexml;
                file_put_contents($path, $xml);
                chmod($path, 0777);
                $this->notafiscal->where('id_nfe', $nota->id_nfe)->update(['chave' => $chave, 'id_status' => 2]);
            }
        } catch (Exception $e) {
            return redirect()->route('admin.notafiscal.index')->withErrors($this->nfe->getErrors());
        }
        return redirect()->route('admin.notafiscal.index')->with('message', 'XML validada com sucesso!');
    }

    public function assinarnfe($idnota)
    {
        $nota               = $this->notafiscal->where('id_nfe', $idnota)->first();
        if (!$nota->chave)
            return redirect()->back()->withErrors('Para assinar o XML, é necessário validar o XML!');

        $notaemitente       = $this->nfeemitente->where('id_nfe', $idnota)->first();
        $configuracao       = $this->configuracao->where('id_configuracao', 1)->first();
        $data = [
            'atualizacao'   => $nota->atualizacao_emitente,
            'tpAmb'         => (int) $configuracao->nfe_ambiente,
            'razaosocial'   => slug($notaemitente->em_xNome),
            'cnpj'          => tira_mascara($notaemitente->em_CNPJ),
            'siglaUF'       => $notaemitente->em_UF,
            'schemes'       => 'PL_009_V4',
            'versao'        => $configuracao->layout,
            'tokenIBPT'     => '',
            'CSC'           => '',
            'CSCid'         => '',
            'proxyConf' => [
                'proxyIp'      => '',
                'proxyPort'    => '',
                'proxyUser'    => '',
                'proxyPass'    => ''
            ]
        ];
        try {
            $c_dg = file_get_contents(base_path() . '\notas\certificados\\' . $configuracao->certificado_digital);
            $nomexml        = $nota->chave . '-nfe.xml';
            $pastaambiente  = ($nota->tpAmb == 1) ? 'producao' : 'homologacao';
            $xml = file_get_contents(base_path() . '\notas\\' . $pastaambiente . '\temporarias\\' . $nomexml);
            $tools = new Tools(json_encode($data), Certificate::readPfx($c_dg, $configuracao->senha));
            $xml_sign = $tools->signNFe($xml);
            $path_xmlsign = base_path() . '\notas\\' . $pastaambiente . '\assinadas\\' . $nomexml;
            file_put_contents($path_xmlsign, $xml_sign);
            chmod($path_xmlsign, 0777);
            $this->notafiscal->where('id_nfe', $nota->id_nfe)->update(['id_status' => 3]);
        } catch (Exception $e) {
            return redirect()->route('admin.notafiscal.index')->withErrors($e->getMessage());
        }
        return redirect()->route('admin.notafiscal.index')->with('message', 'XML assinado com sucesso!');
    }
}
