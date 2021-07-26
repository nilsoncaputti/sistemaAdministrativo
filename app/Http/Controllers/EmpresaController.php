<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades;

use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Http\Requests\EmpresaRequest;

class EmpresaController extends Controller
{
    public function index(Request $request)
    {
        $tipo = $request->tipo;

        if ($tipo !== 'cliente' && $tipo !== 'fornecedor') {
            return \abort(404);
        }

        $empresas = Empresa::todasPorTipo($tipo);

        return view('empresa.index', \compact('empresas', 'tipo'));
    }

    public function create(Request $request)
    {
        $tipo = $request->tipo;

        if ($tipo !== 'cliente' && $tipo !== 'fornecedor') {
            return \abort(404);
        }

        return view('empresa.create', \compact('tipo'));
    }

    public function store(Empresa $request)
    {
        $empresa = Empresa::create($request->all());

        return \redirect()->route('empresas.show', $empresa->id);
    }

    public function show(Empresa $empresa)
    {
        return view('empresa.show', \compact('empresa'));
    }

    public function edit(Empresa $empresa)
    {
        return view('empresa.edit', \compact('empresa'));
    }

    public function update(EmpresaRequest $request, Empresa $empresa)
    {
        $empresa->update($request->all());

        return \redirect()->route('empresas.show', $empresa);
    }

    public function destroy(Empresa $empresa, Request $request)
    {
        $tipo = $request->tipo;

        if ($tipo !== 'cliente' && $tipo !== 'fornecedor') {
            return \abort(404);
        }

        $empresa->delete();

        return \redirect()->route('empresas.index', ['tipo' => $tipo]);
    }
}
