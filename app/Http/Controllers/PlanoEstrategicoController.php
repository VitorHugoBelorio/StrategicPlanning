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
            'titulo' => 'required|string|max:255',
            'visao' => 'required|string',
            'missao' => 'required|string',
            'valores' => 'required|string',
        ]);

        PlanoEstrategico::create([
            'user_id' => Auth::id(),
            'titulo' => $request->titulo,
            'visao' => $request->visao,
            'missao' => $request->missao,
            'valores' => $request->valores,
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
            'titulo' => 'required|string|max:255',
            'visao' => 'required|string',
            'missao' => 'required|string',
            'valores' => 'required|string',
        ]);

        $plano->update($request->only(['titulo', 'visao', 'missao', 'valores']));

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
