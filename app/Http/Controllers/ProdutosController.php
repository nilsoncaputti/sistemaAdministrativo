<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $produtos = Produto::where('nome', 'LIKE', "%$keyword%")
                ->orWhere('descicao', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $produtos = Produto::latest()->paginate($perPage);
        }

        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|max:255'
        ]);
        $requestData = $request->all();

        Produto::create($requestData);

        return redirect('produtos')->with('flash_message', 'Produto added!');
    }

    public function show($id)
    {
        $produto = Produto::findOrFail($id);

        return view('produtos.show', compact('produto'));
    }

    public function edit($id)
    {
        $produto = Produto::findOrFail($id);

        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nome' => 'required|max:255'
        ]);
        $requestData = $request->all();

        $produto = Produto::findOrFail($id);
        $produto->update($requestData);

        return redirect('produtos')->with('flash_message', 'Produto updated!');
    }

    public function destroy($id)
    {
        Produto::destroy($id);

        return redirect('produtos')->with('flash_message', 'Produto deleted!');
    }
}
