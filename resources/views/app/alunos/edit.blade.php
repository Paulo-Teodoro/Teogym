@extends('app._theme')
@section('content')
<div class="cadpessoa">
    <div class="row">
        <div class="col-md-9">
            <h2>Editar Aluno</h2>
        </div>
        <div class="col-md-3 align-buttons">
            <a href="{{ route('relatorios.historicoAluno', $pessoa->id) }}" target="_blank" class="btn btn-info"><i class="fas fa-history"></i> Ver Historico</a>
        </div>   
    </div>    
    <form action="{{ route('alunos.update', $pessoa->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-8">
                <label class="form-label">Nome</label>
                <input type="text" name="name" value="{{ $pessoa->name }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Data de nascimento</label>
                <input type="date" name="data_nasc" value="{{ $pessoa->data_nasc }}" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label class="form-label">Peso</label>
                <input type="number" name="peso" value="{{ $pessoa->peso }}" class="form-control" step=".01">
            </div>
            <div class="col-md-6">
                <label class="form-label">Altura</label>
                <input type="number" name="altura" value="{{ $pessoa->altura }}" class="form-control" step=".01">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label class="form-label">Cpf</label>
                <input type="text" name="cpf" value="{{ $pessoa->cpf }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Telefone</label>
                <input type="text" name="telefone" value="{{ $pessoa->telefone }}" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="form-label">Endereco</label>
                <input type="text" name="endereco" value="{{ $pessoa->endereco }}" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label class="form-label">Objetivo</label>
                <input type="text" name="objetivo" value="{{ $pessoa->objetivo }}" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label class="form-label">E-mail</label>
                <input type="email" name="email" value="{{ $pessoa->email }}" class="form-control">
            </div>
            <input type="hidden" name="id" value="{{ $pessoa->id }}">
        </div>

        <div class="row">
            <div class="col-md-6">
                <label class="form-label">Senha</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Confirme a senha</label>
                <input type="password" name="password_conf" class="form-control">
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Atualizar</button>
    </form>
</div>
@endsection