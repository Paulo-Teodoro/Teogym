<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTreinoRequest;
use App\Models\Rotina;
use App\Models\Treino;
use Illuminate\Http\Request;

class TreinoController extends Controller
{
    private $repository;

    public function __construct(Treino $treino) {
        $this->repository = $treino;
    }
    /**
     * Display a listing of the resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $rotina = Rotina::find($id);
        if(auth()->user()->is_aluno()) {
            if($rotina->aluno_id != auth()->user()->id) {
                abort(403);
            }
        }
        $treinos = $rotina->treinos;

        return view('app.treinos.index', [
            "treinos" => $treinos,
            "rotina" => $rotina
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if(auth()->user()->is_aluno()) {
            abort(403);
        }
        $rotina = Rotina::find($id);
        return view('app.treinos.create', [
            "rotina" => $rotina
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTreinoRequest $request)
    {
        if(auth()->user()->is_aluno()) {
            abort(403);
        }
        if($this->repository->create($request->all()))
            return redirect()->route('treinos.index', $request->rotina_id);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idRotina, $idTreino)
    {
        if(auth()->user()->is_aluno()) {
            abort(403);
        }
        if(!$treino = $this->repository->find($idTreino))
            redirect()->back();

        $exercicios = $treino->exercicios()->get();   
        
        foreach($exercicios as $exercicio) {
            $treino->exercicios()->detach($exercicio->id);
        }

        $treino->delete();

        return redirect()->route('treinos.index', $idRotina);
    }
}
