<?php

namespace App\Http\Controllers;

use App\Models\Questionario;
use App\Models\Questao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestaoController extends Controller
{
    // Listar questões de um questionário
    public function index($questionario_id)
    {
        $questionario = Questionario::where('professor_id', auth()->id())
            ->with('questoes')->findOrFail($questionario_id);
        
        return view('professor.questoes.index', compact('questionario'));
    }

    // Formulário criar questão
    public function create($questionario_id)
    {
        $questionario = Questionario::where('professor_id', auth()->id())
            ->findOrFail($questionario_id);
        
        return view('professor.questoes.create', compact('questionario'));
    }

    // Salvar questão
    public function store(Request $request, $questionario_id)
    {
        $questionario = Questionario::where('professor_id', auth()->id())
            ->findOrFail($questionario_id);

        $validado = $request->validate([
            'enunciado' => 'required|string',
            'imagem' => 'nullable|image|max:2048',
            'alternativa_a' => 'required|string',
            'alternativa_b' => 'required|string',
            'alternativa_c' => 'required|string',
            'alternativa_d' => 'required|string',
            'alternativa_e' => 'required|string',
            'resposta_correta' => 'required|in:A,B,C,D,E',
            'conteudo_linguistico' => 'required|string|max:255',
        ]);

        // Upload de imagem se houver
        $imagem_url = null;
        if ($request->hasFile('imagem')) {
            $imagem_url = $request->file('imagem')->store('questoes', 'public');
        }

        // Determinar ordem
        $ordem = $questionario->questoes()->max('ordem') + 1;

        Questao::create([
            'questionario_id' => $questionario_id,
            'enunciado' => $validado['enunciado'],
            'imagem_url' => $imagem_url,
            'alternativa_a' => $validado['alternativa_a'],
            'alternativa_b' => $validado['alternativa_b'],
            'alternativa_c' => $validado['alternativa_c'],
            'alternativa_d' => $validado['alternativa_d'],
            'alternativa_e' => $validado['alternativa_e'],
            'resposta_correta' => $validado['resposta_correta'],
            'conteudo_linguistico' => $validado['conteudo_linguistico'],
            'ordem' => $ordem,
        ]);

        return redirect()
            ->route('professor.questoes.index', $questionario_id)
            ->with('sucesso', 'Questão adicionada com sucesso!');
    }

    // Excluir questão
    public function destroy($questionario_id, $questao_id)
    {
        $questao = Questao::where('questionario_id', $questionario_id)->findOrFail($questao_id);

        // Excluir imagem se existir
        if ($questao->imagem_url) {
            Storage::disk('public')->delete($questao->imagem_url);
        }

        $questao->delete();

        return back()->with('sucesso', 'Questão excluída com sucesso!');
    }
}