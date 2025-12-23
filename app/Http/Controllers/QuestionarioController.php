<?php

namespace App\Http\Controllers;

use App\Models\Questionario;
use Illuminate\Http\Request;

class QuestionarioController extends Controller
{
    // Listar todos os questionários do professor
    public function index()
    {
        $questionarios = Questionario::where('professor_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('professor.questionarios.index', compact('questionarios'));
    }

    // Exibir formulário de criação
    public function create()
    {
        return view('professor.questionarios.create');
    }

    // Salvar novo questionário
    public function store(Request $request)
    {
        $validado = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $questionario = Questionario::create([
            'professor_id' => auth()->id(),
            'titulo' => $validado['titulo'],
            'descricao' => $validado['descricao'],
            'ativo' => true,
        ]);

        return redirect()
            ->route('professor.questoes.index', $questionario->id)
            ->with('sucesso', 'Questionário criado! Agora adicione as questões.');
    }

    // Exibir um questionário específico
    public function show($id)
    {
        $questionario = Questionario::where('professor_id', auth()->id())
            ->findOrFail($id);

        return view('professor.questionarios.show', compact('questionario'));
    }

    // Exibir formulário de edição
    public function edit($id)
    {
        $questionario = Questionario::where('professor_id', auth()->id())
            ->findOrFail($id);

        return view('professor.questionarios.edit', compact('questionario'));
    }

    // Atualizar questionário
    public function update(Request $request, $id)
    {
        $questionario = Questionario::where('professor_id', auth()->id())
            ->findOrFail($id);

        $validado = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $questionario->update($validado);

        return redirect()
            ->route('professor.questionarios.index')
            ->with('sucesso', 'Questionário atualizado com sucesso!');
    }

    // Excluir questionário
    public function destroy($id)
    {
        $questionario = Questionario::where('professor_id', auth()->id())
            ->findOrFail($id);

        $questionario->delete();

        return redirect()
            ->route('professor.questionarios.index')
            ->with('sucesso', 'Questionário excluído com sucesso!');
    }

    // Alternar status ativo/inativo
    public function toggleStatus($id)
    {
        $questionario = Questionario::where('professor_id', auth()->id())
            ->findOrFail($id);

        if ($questionario->ativo) {
            $questionario->desativar();
            $mensagem = 'Questionário desativado!';
        } else {
            $questionario->ativar();
            $mensagem = 'Questionário ativado!';
        }

        return back()->with('sucesso', $mensagem);
    }
}