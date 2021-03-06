<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercicio extends Model
{
    use HasFactory;
    protected $table = 'exercicio';
    protected $fillable = ['name', 'foco', 'responsavel_id'];

    public function search($filter = null) {
        $results = $this
                    ->where('name', 'LIKE', "%{$filter}%")
                    ->orWhere('foco', 'LIKE', "%{$filter}%")
                    ->paginate();

        return $results;
    }
}
