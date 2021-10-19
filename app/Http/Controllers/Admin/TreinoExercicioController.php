<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTreinoExercicioRequest;
use App\Models\Exercicio;
use App\Models\Rotina;
use App\Models\Treino;
use Illuminate\Http\Request;

class TreinoExercicioController extends Controller
{
    private $repository;

    public function __construct(Treino $treino)
    {
        $this->repository = $treino;
    }
    /**
     * Display a listing of the resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($idRotina, $idTreino)
    {
        $treino = $this->repository->find($idTreino);
        if(auth()->user()->is_aluno()) {
            $rotina = Rotina::find($idRotina);
            if($rotina->aluno_id != auth()->user()->id) {
                abort(403);
            }
        }
        $exercicios = $treino->exercicios()->orderBy('sequencia')->paginate();

        return view('app.treinoExercicio.index', [
            "rotina" => $idRotina,
            "treino" => $idTreino,
            "exercicios" => $exercicios
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idRotina, $idTreino)
    {
        if(auth()->user()->is_aluno()) {
            abort(403);
        }
        $treino = $this->repository->find($idTreino);
        $exercicios = Exercicio::orderBy('name')->get();
        return view('app.treinoExercicio.create', [
            "rotina" => $idRotina,
            "treino" => $treino,
            "exercicios" => $exercicios
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTreinoExercicioRequest $request)
    {
        if(auth()->user()->is_aluno()) {
            abort(403);
        }
        $req = $request->all();
        if(!$treino = $this->repository->find($req['treino_id'])) {
            return redirect()->back();
        }
        
        if(!Exercicio::find($req['exercicio_id'])){
            return redirect()->back()->with('warning', 'Selecione um exercicio');  
        }

        $treino->exercicios()->attach($req['exercicio_id'], [
            "repeticoes" => $req['repeticoes'],
            "series" => $req['series'],
            "sequencia" => $req['sequencia']
        ]);

        return redirect()->route('treino-exercicios.index', [$req['rotina'], $req['treino_id']]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idRotina
     * @param  int  $idTreino
     * @param  int  $idExercicio 
     * @return \Illuminate\Http\Response
     */
    public function destroy($idRotina, $idTreino, $idExercicio)
    {
        if(auth()->user()->is_aluno()) {
            abort(403);
        }
        if(!$treino = $this->repository->find($idTreino))
            redirect()->back();

        $treino->exercicios()->detach($idExercicio);

        return redirect()->route('treino-exercicios.index', [$idRotina, $idTreino]); 
    }
}
