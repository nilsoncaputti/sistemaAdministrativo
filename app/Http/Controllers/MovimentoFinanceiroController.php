<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Movimentos_financeiro;
use Illuminate\Http\Request;

class MovimentoFinanceiroController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $movimentos_financeiros = Movimentos_financeiro::where('descricao', 'LIKE', "%$keyword%")
                ->orWhere('valor', 'LIKE', "%$keyword%")
                ->orWhere('data', 'LIKE', "%$keyword%")
                ->orWhere('tipo', 'LIKE', "%$keyword%")
                ->orWhere('empresa_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $movimentos_financeiros = Movimentos_financeiro::latest()->paginate($perPage);
        }

        return view('movimentos_financeiros.index', compact('movimentos_financeiros'));
    }

    public function create()
    {
        return view('movimentos_financeiros.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
			'descricao' => 'required|string|max:255',
			'data' => 'required',
			'tipo' => 'required',
			'empresa_id' => 'required'
		]);
        $requestData = $request->all();
        
        Movimentos_financeiro::create($requestData);

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

    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'descricao' => 'required|string|max:255',
			'data' => 'required',
			'tipo' => 'required',
			'empresa_id' => 'required'
		]);
        $requestData = $request->all();
        
        $movimentos_financeiro = Movimentos_financeiro::findOrFail($id);
        $movimentos_financeiro->update($requestData);

        return redirect('movimentos_financeiros')->with('flash_message', 'Movimentos_financeiro updated!');
    }

    public function destroy($id)
    {
        Movimentos_financeiro::destroy($id);

        return redirect('movimentos_financeiros')->with('flash_message', 'Movimentos_financeiro deleted!');
    }
}
