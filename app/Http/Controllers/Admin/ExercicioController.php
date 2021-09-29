<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exercicio;
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
        return view('app.exercicios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $req = $request->all();
        $req['responsavel_id'] = 1;

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
    public function update(Request $request, $id)
    {
        if(!$exercicio = $this->repository->find($id))
            dd($exercicio);

        $req = $request->all();
        $req['responsavel_id'] = 1;
        if($exercicio->update($req))
            return redirect()->route('exercicios.index');

        dd($req);    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$exercicio = $this->repository->find($id))
            dd($exercicio);

        $exercicio->delete();
        
        return redirect()->route('exercicios.index');
    }
}