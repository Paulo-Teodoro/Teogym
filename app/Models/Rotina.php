<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rotina extends Model
{
    use HasFactory;
    protected $table = 'rotina';
    protected $fillable = ['responsavel_id','aluno_id','comentario'];

    public function responsavel(){
        return $this->hasOne(Pessoa::class, 'id', 'responsavel_id');
    }

    public function aluno(){
        return $this->hasOne(Pessoa::class, 'id', 'aluno_id');
    }

    public function treinos() {
        return $this->hasMany(Treino::class);
    }

    public function search($filter = null) {
        $pessoas = Pessoa::where('name', 'LIKE', "%{$filter}%")->get();
        $in = "(";
        foreach($pessoas as $pessoa) {
            $in .= "'{$pessoa->id}',";
        }


        $in = substr($in, 0, -1) . ")";

        $results = $this
                    ->whereRaw("responsavel_id IN {$in}")
                    ->orWhereRaw("aluno_id IN {$in}")
                    ->paginate();            

        return $results;
    }
}
