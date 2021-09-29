<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;
    protected $table = 'pessoa';
    protected $fillable = ['name', 'data_nasc', 'peso', 'altura', 'cpf', 'endereco', 'telefone', 'objetivo', 'email', 'senha', 'tipo', 'imc', 'remember_token'];
}
