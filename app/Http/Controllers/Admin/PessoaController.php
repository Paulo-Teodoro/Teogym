<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pessoa;
use DateTime;
use Illuminate\Http\Request;
use stdClass;

class PessoaController extends Controller
{
    private $repository;

    public function __construct(Pessoa $pessoas)
    {
        $this->repository = $pessoas;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = $this->repository->paginate();

        return view('app.alunos.index', [
            'alunos' => $alunos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.alunos.create');
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
        $req['imc'] = $request->peso/($request->altura*$request->altura);

        if($this->repository->create($req))
            return redirect()->route('alunos.index');

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
        if(!$pessoa = $this->repository->find($id))
            return redirect()->back();
        
        $pessoa->data_nasc = (new DateTime($pessoa->data_nasc))->format("Y-m-d"); 
        
        return view('app.alunos.edit', [
            'pessoa' => $pessoa
        ]);
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
        if(!$pessoa = $this->repository->find($id))
            return redirect()->back();

        $req = $request->all();
        $req['imc'] = $request->peso/($request->altura*$request->altura);

        if(!empty($req['senha'])) {
            if (empty($req["senha_conf"]) || $req["senha_conf"] != $req["senha"]) {
                return redirect()->back()->with('warning', 'Para alterar sua senha, informe e repita a nova senha!');
            }
            unset($req['senha_conf']);
        } else {
            unset($req['senha_conf']);
            unset($req['senha']);
        }

        $pessoa->update($req);

        return redirect()->route('alunos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$pessoa = $this->repository->find($id))
            return redirect()->back();
        
        $pessoa->delete();
        
        return redirect()->route('alunos.index');
    }
}
