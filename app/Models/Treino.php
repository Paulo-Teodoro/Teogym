<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treino extends Model
{
    use HasFactory;
    protected $table = 'treino';
    protected $fillable = ['dia', 'foco', 'rotina_id'];

    public function exercicios()
    {
        return $this->belongsToMany(Exercicio::class, 'treino_has_exercicio')
        ->withPivot(['repeticoes','series','sequencia']);
    }
}
