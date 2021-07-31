<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovimentoFinanceiroRequest;

use App\Models\Movimentos_financeiro;
use DateTime;
use Illuminate\Http\Request;

class MovimentoFinanceiroController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->filled('data_inicial') || !$request->filled('data_final')) {
            return \redirect()->route('movimentos_financeiros.index', [
                'data_inicial' => (new DateTime('first day of this month'))->format('d/m/Y'),
                'data_final' => (new DateTime('last day of this month'))->format('d/m/Y'),
            ]);
        }

        $movimentos_financeiros = Movimentos_financeiro::buscaPorIntervalo(
            data_br_para_iso($request->data_inicial),
            data_br_para_iso($request->data_final)
        );

        return view('movimentos_financeiros.index', compact('movimentos_financeiros'));
    }

    public function create()
    {
        return view('movimentos_financeiros.create');
    }

    public function store(MovimentoFinanceiroRequest $request)
    {
        Movimentos_financeiro::create($request->all());

        return redirect('movimentos_financeiros')->with('flash_message', 'Movimentos_financeiro added!');
    }

    public function show($id)
    {
        $movimentos_financeiro = Movimentos_financeiro::findOrFail($id);

        return view('movimentos_financeiros.show', compact('movimentos_financeiro'));
    }

    public function edit($id)
    {
        $movimentos_financeiro = Movimentos_financeiro::findOrFail($id);

        return view('movimentos_financeiros.edit', compact('movimentos_financeiro'));
    }

    public function update(MovimentoFinanceiroRequest $request, $id)
    {
        $movimentos_financeiro = Movimentos_financeiro::findOrFail($id);
        $movimentos_financeiro->update($request->all());

        return redirect('movimentos_financeiros')->with('flash_message', 'Movimentos_financeiro updated!');
    }

    public function destroy($id)
    {
        Movimentos_financeiro::destroy($id);

        return redirect('movimentos_financeiros')->with('flash_message', 'Movimentos_financeiro deleted!');
    }
}
