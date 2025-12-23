<?php

namespace App\Http\Controllers;

use App\Models\Questionario;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function painel()
    {
        $totalQuestionarios = Questionario::where('professor_id', auth()->id())->count();
        $questionariosAtivos = Questionario::where('professor_id', auth()->id())
            ->where('ativo', true)->count();
        
        return view('professor.painel', compact('totalQuestionarios', 'questionariosAtivos'));
    }
}