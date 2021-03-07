<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateClientes extends FormRequest
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
            'nome'              => 'nullable', 
            'nome_fantasia'     => 'nullable', 
            'cpf'               => 'nullable', 
            'cnpj'              => 'nullable', 
            'fone'              => 'nullable', 
            'celular'           => 'nullable', 
            'email'             => 'nullable', 
            'cep'               => 'nullable', 
            'logradouro'        => 'nullable',
            'numero'            => 'nullable', 
            'uf'                => 'nullable', 
            'cidade'            => 'nullable', 
            'complemento'       => 'nullable', 
            'bairro'            => 'nullable', 
            'ie'                => 'nullable', 
            'im'                => 'nullable', 
            'rg'                => 'nullable', 
            'suframa'           => 'nullable',
            'cod_estrangeiro'   => 'nullable', 
            'ie_subt_trib'      => 'nullable', 
            'indIEDest'         => 'nullable', 
            'ibge'              => 'nullable'
        ];
    }
}
