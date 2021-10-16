<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pessoa;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
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
        if(!auth()->user()->is_admin()) {
            abort(403);
        }

        $admins = $this->repository->where('tipo',1)->where('ativo',1)->paginate();

        return view('app.admins.index', [
            'admins' => $admins
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->is_admin()) {
            abort(403);
        }
        return view('app.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!auth()->user()->is_admin()) {
            abort(403);
        }
        $req = $request->all();
        $req['password'] = Hash::make($request->password);
        $req['tipo'] = 1;

        if($this->repository->create($req))
            return redirect()->route('admins.index');
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
        if(!$pessoa = $this->repository->where('tipo', 1)->find($id))
            return redirect()->back()->with('warning', "Ooops! este administrador não existe");
        
        if(!auth()->user()->is_admin()) {
                abort(403);  
        }            
        
        $pessoa->data_nasc = (new DateTime($pessoa->data_nasc))->format("Y-m-d"); 
        
        return view('app.admins.edit', [
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
        if(!$pessoa = $this->repository->where('tipo', 1)->find($id)) {
            return redirect()->back()->with('warning', "Ooops! este administrador não existe");
        }   

        if(!auth()->user()->is_admin()) {
            abort(403);  
        } 

        $req = $request->all();

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

        $req['tipo'] = 1;

        $pessoa->update($req);
        
        return redirect()->route('admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!auth()->user()->is_admin()) {
            abort(403);
        }
        if(!$pessoa = $this->repository->where('tipo', 1)->find($id))
            return redirect()->back()->with('warning', "Ooops! este administrador não existe");
            
        $pessoa->ativo = 0;
        $pessoa->update();
        
        return redirect()->route('admins.index');
    }
}