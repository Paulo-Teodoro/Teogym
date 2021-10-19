<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateExercicioRequest;
use App\Models\Exercicio;
use App\Models\TreinoExercicio;
use Illuminate\Http\Request;

class ExercicioController extends Controller
{
    private $repository;

    public function __construct(Exercicio $exercicios)
    {
        $this->repository = $exercicios;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->is_aluno()) {
            abort(403);
        }
        $exercicios = $this->repository->paginate();

        return view('app.exercicios.index', [
            "exercicios" => $exercicios
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
        return view('app.exercicios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateExercicioRequest $request)
    {
        if(auth()->user()->is_aluno()) {
            abort(403);
        }
        $req = $request->all();
        $req['responsavel_id'] = auth()->user()->id;

        if(!$this->repository->create($req))
            return dd($req);

        return redirect()->route('exercicios.index');   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->is_aluno()) {
            abort(403);
        }
        if($exercicio = $this->repository->find($id))
            return view('app.exercicios.edit',[
                "exercicio" => $exercicio
            ]);
         
        dd($exercicio);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateExercicioRequest $request, $id)
    {
        if(auth()->user()->is_aluno()) {
            abort(403);
        }
        if(!$exercicio = $this->repository->find($id))
            return redirect()->back();

        $req = $request->all();
        $req['responsavel_id'] = auth()->user()->id;
        if($exercicio->update($req))
            return redirect()->route('exercicios.index');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->is_aluno()) {
            abort(403);
        }
        if(!$exercicio = $this->repository->find($id))
            return redirect()->back()->with('warning', "Ooops! este exercicio não existe");

        $treinos = TreinoExercicio::where('exercicio_id', $id)->get();
        if($treinos->count() > 0) {
            return redirect()->back()->with('warning', "Ooops! este exercicio já está em uma rotina e não pode ser deletado");
        }    

        $exercicio->delete();
        
        return redirect()->route('exercicios.index');
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
        $exercicios = $this->repository->search($request->filter);

        return view('app.exercicios.index', [
            'exercicios' => $exercicios,
            'filters' => $filters
        ]);
    }
}
