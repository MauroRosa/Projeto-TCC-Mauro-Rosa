<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespostaAluno extends Model
{
    use HasFactory;

    protected $table = 'respostas_alunos';
    
    protected $fillable = [
        'aluno_id', 'questao_id', 'questionario_id',
        'resposta_escolhida', 'correta', 'familiaridade'
    ];

    protected $casts = ['correta' => 'boolean'];

    // Relacionamentos
    public function aluno() {
        return $this->belongsTo(User::class, 'aluno_id');
    }

    public function questao() {
        return $this->belongsTo(Questao::class);
    }

    public function questionario() {
        return $this->belongsTo(Questionario::class);
    }
}