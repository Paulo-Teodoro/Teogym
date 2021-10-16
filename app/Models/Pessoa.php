<?php

namespace App\Models;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pessoa extends User
{
    use HasFactory;
    use Notifiable;
    use HasApiTokens;
    use CanResetPassword;
    
    protected $table = 'pessoa';
    protected $fillable = ['name', 'data_nasc', 'peso', 'altura', 'cpf', 'endereco', 'telefone', 'objetivo', 'email', 'password', 'tipo', 'imc', 'remember_token'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAuthPassword()
    {
     return $this->password;
    }

    public function is_admin() {
        if($this->tipo == 1){
            return true;
        }
        return false;
    }

    public function is_personal() {
        if($this->tipo == 2){
            return true;
        }
        return false;
    }

    public function is_aluno() {
        if($this->tipo == 3){
            return true;
        }
        return false;
    }

    public function is_ativo() {
        if($this->ativo == true) {
            return true;
        }
        return false;
    }

    public function alunoRotinas()
    {
        return $this->hasMany(Rotina::class,'aluno_id');
    }

}
