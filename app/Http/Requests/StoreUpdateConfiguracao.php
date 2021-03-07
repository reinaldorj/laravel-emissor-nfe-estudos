<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateConfiguracao extends FormRequest
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
            'layout'                => 'required',
            'nfe_serie'             => 'required',
            'tipo_nota_padrao'      => 'required',
            'nfe_ambiente'          => 'required',
            'nfe_versao'            => 'required',
            'empresa_padrao'        => 'required',
            'ultimanfe'             => 'required',
            'natureza_padrao'       => 'required',
            'indFinal'              => 'required',
            'tipo_frete'            => 'required',
            'certificado_digital'   => 'required', 
            'senha'                 => 'required'
        ];
    }
}
