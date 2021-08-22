<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\EmpresaRequest;
use App\Models\Saldo;
use Symfony\Component\HttpFoundation\Response;

class EmpresaController extends Controller
{
    public function index(Request $request): View
    {
        $tipo = $request->tipo;
        $this->validaTipo($tipo);

        $busca = $request->search ?? '';

        $empresas = Empresa::todasPorTipo($tipo, $busca);

        return view('empresa.index', \compact('empresas', 'tipo'));
    }

    public function create(Request $request): View
    {
        $this->validaTipo($request->tipo);

        return view('empresa.create', [
            'tipo' => $request->tipo
        ]);
    }

    public function store(EmpresaRequest $request): Response
    {
        $empresa = Empresa::create($request->all());

        return \redirect()->route('empresas.show', $empresa->id);
    }

    public function show(int $id): View
    {
        return view('empresa.show', [
            'empresa' => Empresa::BuscaPorId($id),
            'saldo' => Saldo::ultimoDaEmpresa($id),
        ]);
    }

    public function edit(Empresa $empresa): View
    {
        return view('empresa.edit', \compact('empresa'));
    }

    public function update(EmpresaRequest $request, Empresa $empresa): Response
    {
        $empresa->update($request->all());

        return \redirect()->route('empresas.show', $empresa);
    }

    public function destroy(Empresa $empresa, Request $request): Response
    {
        $this->validaTipo($request->tipo);

        $empresa->delete();

        return \redirect()->route('empresas.index', ['tipo' => $request->tipo]);
    }

    //Verficia o tipo se é Cliente ou Fornecedor
    private function validaTipo(string $tipo): void
    {
        if ($tipo !== 'cliente' && $tipo !== 'fornecedor') {
            \abort(404);
        }
    }
}
