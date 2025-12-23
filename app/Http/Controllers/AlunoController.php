<?php

namespace App\Http\Controllers;

use App\Models\Questionario;
use App\Models\Questao;
use App\Models\RespostaAluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    // Painel do aluno
    public function painel()
    {
        $totalQuestionarios = Questionario::where('ativo', true)->count();
        $questionariosResolvidos = RespostaAluno::where('aluno_id', auth()->id())
            ->distinct('questionario_id')->count('questionario_id');
        
        return view('aluno.painel', compact('totalQuestionarios', 'questionariosResolvidos'));
    }

    // Listar questionários disponíveis
    public function questionarios()
    {
        $questionarios = Questionario::where('ativo', true)
            ->withCount('questoes')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('aluno.questionarios.index', compact('questionarios'));
    }

    // Iniciar questionário
    public function iniciarQuestionario($id)
    {
        $questionario = Questionario::where('ativo', true)
            ->with('questoes')
            ->findOrFail($id);
        
        // Verificar se já respondeu
        $jaRespondeu = RespostaAluno::where('aluno_id', auth()->id())
            ->where('questionario_id', $id)
            ->exists();
        
        if ($jaRespondeu) {
            return redirect()
                ->route('aluno.resultado', $id)
                ->with('info', 'Você já respondeu este questionário.');
        }
        
        return view('aluno.questionarios.resolver', compact('questionario'));
    }

    // Salvar respostas
    public function salvarRespostas(Request $request, $id)
    {
        $questionario = Questionario::findOrFail($id);
        $questoes = $questionario->questoes;

        foreach ($questoes as $questao) {
            $resposta = $request->input("questao_{$questao->id}");
            $familiaridade = $request->input("familiaridade_{$questao->id}");

            if ($resposta) {
                RespostaAluno::create([
                    'aluno_id' => auth()->id(),
                    'questao_id' => $questao->id,
                    'questionario_id' => $id,
                    'resposta_escolhida' => $resposta,
                    'correta' => ($resposta === $questao->resposta_correta),
                    'familiaridade' => $familiaridade ?? 'nao_conheco',
                ]);
            }
        }

        return redirect()
            ->route('aluno.resultado', $id)
            ->with('sucesso', 'Questionário finalizado!');
    }

    // Ver resultado
    public function resultado($id)
    {
        $questionario = Questionario::findOrFail($id);
        
        $respostas = RespostaAluno::where('aluno_id', auth()->id())
            ->where('questionario_id', $id)
            ->with('questao')
            ->get();

        $totalQuestoes = $respostas->count();
        $acertos = $respostas->where('correta', true)->count();
        $erros = $totalQuestoes - $acertos;
        $percentual = $totalQuestoes > 0 ? round(($acertos / $totalQuestoes) * 100, 2) : 0;

        // Conteúdos para revisar
        $conteudosRevisar = $respostas->where('correta', false)
            ->pluck('questao.conteudo_linguistico')
            ->unique()
            ->values();

        return view('aluno.questionarios.resultado', compact(
            'questionario', 'totalQuestoes', 'acertos', 
            'erros', 'percentual', 'conteudosRevisar'
        ));
    }
}