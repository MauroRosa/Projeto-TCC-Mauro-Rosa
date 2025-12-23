<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conteudo extends Model
{
    use HasFactory;

    protected $fillable = ['professor_id', 'titulo', 'tipo', 'conteudo', 'url', 'arquivo_path'];

    // Relacionamento
    public function professor() {
        return $this->belongsTo(User::class, 'professor_id');
    }

    // Métodos auxiliares
    public function ehPDF() {
        return $this->tipo === 'pdf';
    }

    public function ehLink() {
        return $this->tipo === 'link';
    }

    public function ehTexto() {
        return $this->tipo === 'texto';
    }
}