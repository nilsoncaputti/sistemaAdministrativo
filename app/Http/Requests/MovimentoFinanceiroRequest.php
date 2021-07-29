<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MovimentoFinanceiroRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'descricao' => 'required|string|max:255',
            'data' => 'required|date',
            'valor' => 'required|numeric',
			'tipo' => 'required',
			'empresa_id' => 'required'
        ];
    }

    public function validationData()
    {
        $campos = $this->all();

        $campos['valor'] = \str_replace(['.', ','], ['', '.'], $campos['valor']);
        $campos['data'] = data_br_para_iso($campos['data']);

        $this->replace($campos);

        return $campos;
    }
}