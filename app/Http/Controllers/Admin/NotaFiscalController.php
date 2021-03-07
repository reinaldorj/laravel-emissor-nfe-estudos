<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nfe;
use App\Models\Venda;
use App\Models\Emitente;
use Illuminate\Http\Request;

class NotaFiscalController extends Controller
{
    private $repository, $venda, $emitente;

    /**
     * NOTA
     * 
     * $configuracao        = $configuracao->id_configuracao //vem da tabela configuracao
     * $empresa             = $configuracao->empresa_padrao //vem da tabela configuracao
     * 
     * 
     * intens que compõe a tabela nfe
     * 
     * id_venda             = $venda->id_venda              // vem da tabela vendas
     * cUF                  = idestado                      //vem da tabela estado
     * natOp                = $confuguracao->naturezaOp     //vem da tabela configuracao
     * indPag               = 0                             //não existemais
     * modelo               = 55                            //modelo da nota
     * serie                = $configuracao->serie          //vem da tabela configuracao
     * nNF                  = $configuracao->ultimanfe      //vem da tabela configuracao + 1 | notas precisa seguir uma ordem cronológica, não pode pular
     * cNF                  = rand($nota->nNF, 99999999)    //gera um nº aleatório para a nf
     */

    public function __construct(Nfe $repository, Venda $venda, Emitente $emitente)
    {
        $this->repository   = $repository;
        $this->venda        = $venda;
        $this->emitente     = $emitente;
    }
}
