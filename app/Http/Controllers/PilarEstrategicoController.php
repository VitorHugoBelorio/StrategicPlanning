<?php

namespace App\Http\Controllers;

use App\Models\PilarEstrategico;
use App\Models\PlanoEstrategico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PilarEstrategicoController extends Controller
{
    /**
     * Exibe a lista de pilares de um plano estratégico específico.
     */
    public function index($planoId)
    {
        $plano = PlanoEstrategico::where('user_id', Auth::id())->findOrFail($planoId);
        $pilares = $plano->pilares;
        return view('pilares.index', compact('plano', 'pilares'));
    }

    /**
     * Exibe o formulário de criação de um novo pilar.
     */
    public function create($planoId)
    {
        $plano = PlanoEstrategico::where('user_id', Auth::id())->findOrFail($planoId);
        return view('pilares.create', compact('plano'));
    }

    /**
     * Armazena um novo pilar no banco.
     */
    public function store(Request $request, $planoId)
    {
        $plano = PlanoEstrategico::where('user_id', Auth::id())->findOrFail($planoId);

        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        PilarEstrategico::create([
            'plano_estrategico_id' => $plano->id,
            'nome' => $request->nome,
        ]);

        return redirect()->route('planos.show', $plano->id)->with('success', 'Pilar estratégico criado com sucesso!');
    }

    /**
     * Exibe o formulário de edição de um pilar.
     */
    public function edit($id)
    {
        $pilar = PilarEstrategico::findOrFail($id);
        $plano = $pilar->plano;

        if ($plano->user_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }

        return view('pilares.edit', compact('pilar'));
    }

    /**
     * Atualiza um pilar existente.
     */
    public function update(Request $request, $id)
    {
        $pilar = PilarEstrategico::findOrFail($id);
        $plano = $pilar->plano;

        if ($plano->user_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }

        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $pilar->update([
            'nome' => $request->nome,
        ]);

        return redirect()->route('planos.show', $plano->id)->with('success', 'Pilar estratégico atualizado com sucesso!');
    }

    /**
     * Remove um pilar do banco.
     */
    public function destroy($id)
    {
        $pilar = PilarEstrategico::findOrFail($id);
        $plano = $pilar->plano;

        if ($plano->user_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }

        $pilar->delete();

        return redirect()->route('planos.show', $plano->id)->with('success', 'Pilar estratégico excluído com sucesso!');
    }
}
