<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionario extends Model
{
    use HasFactory;

    protected $fillable = ['professor_id', 'titulo', 'descricao', 'ativo'];
    protected $casts = ['ativo' => 'boolean'];

    // Relacionamentos
    public function professor() {
        return $this->belongsTo(User::class, 'professor_id');
    }

    public function questoes() {
        return $this->hasMany(Questao::class)->orderBy('ordem');
    }

    public function respostasAlunos() {
        return $this->hasMany(RespostaAluno::class);
    }
}