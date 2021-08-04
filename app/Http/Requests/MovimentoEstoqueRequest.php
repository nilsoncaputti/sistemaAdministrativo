<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MovimentoEstoqueRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'produto_id' => 'required',
            'quantidade' => 'required|numeric',
            'valor' => 'required|numeric',
            'tipo' => ['required', Rule::in(['entrada', 'saida'])],
            'empresa_id' => 'required'
        ];
    }

    public function validationData()
    {
        $campos = $this->all();

        $campos['valor'] = numero_br_para_iso($campos['valor']);
        $campos['quantidade'] = numero_br_para_iso($campos['quantidade']);

        $this->replace($campos);

        return $campos;
    }
}
