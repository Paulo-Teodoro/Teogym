@extends('app._theme')
@section('content')
<div class="cadpessoa">
    <h1>Cadastrar Administrador</h1>
    <form action="{{ route('admins.store') }}" method="POST">
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
            <div class="col-md-8">
                <label class="form-label">email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">senha</label>
                <input type="password" name="password" class="form-control">
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
</div>
@endsection