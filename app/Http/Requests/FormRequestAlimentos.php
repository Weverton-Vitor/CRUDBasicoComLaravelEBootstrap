<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
 use Illuminate\Validation\Rule;

class FormRequestAlimentos extends FormRequest
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
            'nome' => 'required|max:60',
            'preco' => 'required',
            'marca' => 'required|max:60',            
            'data_fabricacao' => 'required',
            'data_validade' => 'required',                 
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo [Nome] é obrigatório',
            'nome.max' => 'O campo [nome] tem tamanho máximo de 60 caracteres',
            'preco.required' => 'O campo [Preço] é obrigatório',
            'marca.required' => 'O campo [Marca] é obrigatório',
            'marca.max' => 'O campo [Marca] tem tamanho máximo de 60 caracteres',
            'data_fabricacao.required' => 'O campo [Data de fabricação] é obrigatório',
            'data_validade.required' => 'O campo [Data de validade] é obrigatório'
        ];
    }

}
