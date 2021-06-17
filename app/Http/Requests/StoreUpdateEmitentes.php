<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateEmitentes extends FormRequest
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
            'razao_social'          => 'required|min:3|max:255', 
            'nome_fantasia'         => 'required|min:3|max:255',
            'cnpj'                  => 'required|min:18|max:18', 
            'ie'                    => 'required', 
            'iest'                  => 'nullable', 
            'im'                    => 'nullable', 
            'fone'                  => 'required',          
            'email'                 => 'required', 
            'email_contabilidade'   => 'required', 
            'cep'                   => 'required|min:9', 
            'logradouro'            => 'required', 
            'complemento'           => 'required',
            'numero'                => 'required', 
            'uf'                    => 'required', 
            'cidade'                => 'required', 
            'bairro'                => 'required', 
            'cnae'                  => 'nullable', 
            'regime_tributario'     => 'required', 
            'ibge'                  => 'required'
        ];
    }
}
