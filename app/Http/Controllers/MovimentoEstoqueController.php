<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovimentosEstoque;
use App\Http\Requests\MovimentoEstoqueRequest;

class MovimentoEstoqueController extends Controller
{
    //Cria movimento de estoque
    public function store(MovimentoEstoqueRequest $request)
    {
        dd($request->all());

        $dados = $request->all();
        $dados['tipo'] = 'entrada';

        MovimentosEstoque::create($dados);

        return \redirect()->back();
    }

    //Apaga movimento de estoque
    public function destroy(int $id)
    {
        MovimentosEstoque::destroy($id);

        return \redirect()->back();
    }
}
