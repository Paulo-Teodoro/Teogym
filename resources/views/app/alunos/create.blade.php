@extends('app._theme')
@section('content')
<div class="cadpessoa">
    <h1>Cadastrar Pessoa</h1>
    <form action="{{ route('alunos.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <label class="form-label">nome</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">data de nascimento</label>
                <input type="date" name="data_nasc" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label class="form-label">peso</label>
                <input type="number" name="peso" class="form-control" step=".01">
            </div>
            <div class="col-md-6">
                <label class="form-label">altura</label>
                <input type="number" name="altura" class="form-control" step=".01">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label class="form-label">cpf</label>
                <input type="text" name="cpf" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">telefone</label>
                <input type="text" name="telefone" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="form-label">endereco</label>
                <input type="text" name="endereco" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label class="form-label">objetivo</label>
                <input type="text" name="objetivo" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <label class="form-label">email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">senha</label>
                <input type="password" name="senha" class="form-control">
            </div>
        </div>
        <label class="form-label">Tipo</label><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tipo" value="1" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
                Administrador
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tipo" value="2" id="flexRadioDefault2">
            <label class="form-check-label" for="flexRadioDefault2">
                Personal
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tipo" value="3" id="flexRadioDefault3" checked>
            <label class="form-check-label" for="flexRadioDefault3">
                Aluno
            </label>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
</div>
@endsection