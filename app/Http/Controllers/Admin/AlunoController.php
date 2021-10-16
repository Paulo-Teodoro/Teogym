<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlunoRequest;
use App\Http\Requests\UpdateAlunoRequest;
use App\Models\Historico;
use App\Models\Pessoa;
use DateTime;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use stdClass;

class AlunoController extends Controller
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
        if(auth()->user()->is_aluno()) {
            abort(403);
        }

        $alunos = $this->repository->where('tipo',3)->paginate();

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
        if(auth()->user()->is_aluno()) {
            abort(403);
        }
        return view('app.alunos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlunoRequest $request)
    {
        if(auth()->user()->is_aluno()) {
            abort(403);
        }
        $req = $request->all();
        $req['imc'] = $request->peso/($request->altura*$request->altura);
        $req['password'] = Hash::make($request->password);
        $req['tipo'] = 3;

        if($aluno = $this->repository->create($req)) {
            $hist = [
                "imc" => $req['imc'],
                "altura" => $req['altura'],
                "peso" => $req['peso'],
                "aluno_id" => $aluno->id
            ];
            Historico::create($hist);
            return redirect()->route('alunos.index')->with('info', "Aluno {$aluno->name} criado com sucesso");
        }
        return redirect()->route('alunos.index')->with('error', "Ooops! tivemos algum erro mas já estamos resolvendo");
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
        if(!$pessoa = $this->repository->where('tipo',3)->find($id))
            return redirect()->back()->with('warning', "Ooops! este aluno não existe");
        
        if(auth()->user()->is_aluno()) {
            if(auth()->user()->id != $id) {
                abort(403);
            }
        }            
        
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
    public function update(UpdateAlunoRequest $request, $id)
    {
        if(!$pessoa = $this->repository->where('tipo',3)->find($id))
            return redirect()->back()->with('warning', "Ooops! este aluno não existe");

        if(auth()->user()->is_aluno()) {
            if(auth()->user()->id != $id) {
                //abort(403);
                dd($id);
            }
        }    

        $req = $request->all();
        $req['imc'] = $request->peso/($request->altura*$request->altura);

        if(!empty($req['password'])) {
            if (empty($req["password_conf"]) || $req["password_conf"] != $req["password"]) {
                return redirect()->back()->with('warning', 'Para alterar sua senha, informe e repita a nova senha!');
            }
            unset($req['password_conf']);
            $req['password'] = Hash::make($request->password);
        } else {
            unset($req['password_conf']);
            unset($req['password']);
        }

        $req['tipo'] = 3;

        $pessoa->update($req);
        $hist = [
            "imc" => $req['imc'],
            "altura" => $req['altura'],
            "peso" => $req['peso'],
            "aluno_id" => $pessoa->id
        ];
        Historico::create($hist);

        if(!auth()->user()->is_aluno()) {
            return redirect()->route('alunos.index')->with('info', "Aluno {$pessoa->name} editado com sucesso");
        } else {
            return redirect()->route('alunos.edit', $id);
        }
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
        if(!$pessoa = $this->repository->where('tipo',3)->find($id))
            return redirect()->back()->with('warning', "Ooops! este aluno não existe");

        if($pessoa->alunoRotinas()->count() > 0) {
            return redirect()->back()->with('warning', "Verifique se o aluno {$pessoa->name} está vinculado a alguma rotina e tente novamente!");
        }            
        
        $pessoa->delete();
        
        return redirect()->route('alunos.index')->with('error', "o aluno {$pessoa->name} foi deletado!");
    }
}
