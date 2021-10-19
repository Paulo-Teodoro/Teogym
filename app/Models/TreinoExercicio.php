<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreinoExercicio extends Model
{
    use HasFactory;
    protected $table = 'treino_has_exercicio';
    protected $fillable = ['repeticoes','series','sequencia','treino_id','exercicio_id'];
}
