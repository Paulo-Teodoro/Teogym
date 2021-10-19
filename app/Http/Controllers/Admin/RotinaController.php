<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRotinaRequest;
use App\Models\Pessoa;
use App\Models\Rotina;
use Illuminate\Http\Request;

class RotinaController extends Controller
{
    private $repository;

    public function __construct(Rotina $rotina)
    {
        $this->repository = $rotina;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->is_aluno()) {
            $rotinas = $this->repository->where('aluno_id', auth()->user()->id)->paginate();
        } else {
        $rotinas = $this->repository->paginate(); 
        }

        return view('app.rotinas.index', [
            "rotinas" => $rotinas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->is_aluno()) {
            abort(403);
        }
        $alunos = Pessoa::where('tipo', 3)->get();
        return view('app.rotinas.create', [
            "alunos" => $alunos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->is_aluno()) {
            abort(403);
        }
        if(!Pessoa::where('tipo',3)->find($request->aluno)) {
            return redirect()->back()->with('warning', 'Por favor selecione um aluno');
        }
        $req = [
            "responsavel_id" => auth()->user()->id,
            "aluno_id" => $request->aluno
        ];

        if($this->repository->create($req))
            return redirect()->route('rotinas.index');

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
    public function destroy($id)
    {
        if(!$rotina = $this->repository->find($id))
            return redirect()->back();
        
        $treinos = $rotina->treinos; 
        
        foreach($treinos as $treino) {
            $treinoController = new TreinoController($treino);
            $treinoController->destroy($rotina->id, $treino->id);
        }
        
        $rotina->delete();
        
        return redirect()->route('rotinas.index');
    }

    /**
     * Search results
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) 
    {
        $filters = $request->except('_token');
        $rotinas = $this->repository->search($request->filter);

        return view('app.rotinas.index', [
            'rotinas' => $rotinas,
            'filters' => $filters
        ]);
    }
}
