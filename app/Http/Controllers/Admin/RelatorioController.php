<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Historico;
use App\Models\Pessoa;
use App\Models\Rotina;
use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->is_admin()) {
            abort(403);
        }

        return view('app.relatorios.index');
    }

    public function lastAlunos() {
        if(!auth()->user()->is_admin()) {
            abort(403);
        }
        $alunos = Pessoa::where('tipo', 3)
                            ->whereRaw('month(created_at) = month(now())')
                            ->get();

        return PDF::loadView('app.relatorios.lastAlunos', [
            "alunos" => $alunos
        ])->stream();
    }

    public function rotinaPessoa() {
        if(!auth()->user()->is_admin()) {
            abort(403);
        }
        $pessoas = DB::table('rotina')
                ->select(DB::raw('count(*) as qtd, pessoa.name'))
                ->join('pessoa', 'pessoa.id', '=', 'rotina.responsavel_id')
                ->groupBy('responsavel_id')
                ->get();

        return PDF::loadView('app.relatorios.rotinaPessoa', [
            "pessoas" => $pessoas
        ])->stream();        
    }   

    /**
     * List routine in pdf
     *
     * @return \Illuminate\Http\Response
     */
    public function rotina($id) {
        $rotina = Rotina::find($id);
        if(auth()->user()->is_aluno()) {
            if($rotina->aluno_id != auth()->user()->id) {
                abort(403);
            }
        }
        $treinos = $rotina->treinos;

        return PDF::loadView('app.relatorios.rotina', [
            "treinos" => $treinos
        ])->stream();
    }

    /**
     * List history in pdf
     *
     * @return \Illuminate\Http\Response
     */
    public function historicoAluno($id) {
        if(auth()->user()->is_aluno()) {
            if($rotina->aluno_id != auth()->user()->id) {
                abort(403);
            }
        }
        $historicos = Historico::where('aluno_id', $id)
                ->orderBy('created_at')
                ->get();

        return PDF::loadView('app.relatorios.historicoAluno', [
            "historicos" => $historicos
        ])->stream();        
    }
}
