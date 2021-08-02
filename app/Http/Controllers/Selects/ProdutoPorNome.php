<?php

namespace App\Http\Controllers\Selects;

use App\Models\Produto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class produtoPorNome extends Controller
{
    public function __invoke(Request $request)
    {
        $nome = $request->nome ?? '';

        return Produto::buscarPorNome($nome);
    }
}
