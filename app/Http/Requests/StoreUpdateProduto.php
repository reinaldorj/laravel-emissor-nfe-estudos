<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProduto extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_unidade'    => 'required',
            'produto'       => 'required',
            'preco'         => 'required',
            'cfop'          => 'required',
            'gtin'          => 'nullable',
            'ncm'           => 'required',
            'cest'          => 'required',
            //'cbenef'        => 'nullable',
            'extipi'        => 'required',
            'mva'           => 'required',
            'nfci'          => 'required',
            'sku'           => 'nullable',
            'quantidade'    => 'nullable',
            'comprimento'   => 'nullable',
            'altura'        => 'nullable',
            'largura'       => 'nullable',
            'id_und_peso'   => 'nullable',
            'id_und_medida' => 'nullable',
        ];
    }
}
