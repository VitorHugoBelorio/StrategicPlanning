<?php

namespace App\Http\Controllers;

use App\Models\PlanoEstrategico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanoEstrategicoController extends Controller
{
    /**
     * Exibe todos os planos do usuário logado.
     */
    public function index()
    {
        $planos = PlanoEstrategico::where('user_id', Auth::id())->get();
        return view('planos.index', compact('planos'));
    }

    /**
     * Exibe o formulário de criação de um novo plano.
     */
    public function create()
    {
        return view('planos.create');
    }

    /**
     * Armazena um novo plano no banco.
     */
    public function store(Request $request)
    {
        $request->validate([
            'area_interesse' => 'required|string|max:255',
            'objetivo_geral' => 'required|string',
            'prazo_meses' => 'required|integer|min:1',
        ]);

        PlanoEstrategico::create([
            'user_id' => Auth::id(),
            'area_interesse' => $request->area_interesse,
            'objetivo_geral' => $request->objetivo_geral,
            'prazo_meses' => $request->prazo_meses,
        ]);

        return redirect()->route('planos.index')->with('success', 'Plano estratégico criado com sucesso!');
    }

    /**
     * Exibe os detalhes de um plano.
     */
    public function show(PlanoEstrategico $plano)
    {
        $this->authorizeOwner($plano);
        return view('planos.show', compact('plano'));
    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit(PlanoEstrategico $plano)
    {
        $this->authorizeOwner($plano);
        return view('planos.edit', compact('plano'));
    }

    /**
     * Atualiza o plano.
     */
    public function update(Request $request, PlanoEstrategico $plano)
    {
        $this->authorizeOwner($plano);

        $request->validate([
            'area_interesse' => 'required|string|max:255',
            'objetivo_geral' => 'required|string',
            'prazo_meses' => 'required|integer|min:1',
        ]);

        $plano->update($request->only(['area_interesse', 'objetivo_geral', 'prazo_meses']));

        return redirect()->route('planos.index')->with('success', 'Plano atualizado com sucesso!');
    }

    /**
     * Remove o plano.
     */
    public function destroy(PlanoEstrategico $plano)
    {
        $this->authorizeOwner($plano);
        $plano->delete();

        return redirect()->route('planos.index')->with('success', 'Plano removido com sucesso!');
    }

    /**
     * Garante que o plano pertence ao usuário logado.
     */
    private function authorizeOwner(PlanoEstrategico $plano)
    {
        if ($plano->user_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }
    }
}
