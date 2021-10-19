@extends('app._theme')
@section('content')
<div class="cadpessoa">
    <h1>Cadastrar Aluno</h1>
    <form action="{{ route('alunos.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <label class="form-label">Nome</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Data de Nascimento</label>
                <input type="date" name="data_nasc" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label class="form-label">Peso</label>
                <input type="number" name="peso" class="form-control" step=".01">
            </div>
            <div class="col-md-6">
                <label class="form-label">Altura</label>
                <input type="number" name="altura" class="form-control" step=".01">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label class="form-label">Cpf</label>
                <input type="text" name="cpf" id="cpf" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Telefone</label>
                <input type="text" name="telefone" id="telefone" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="form-label">Endereco</label>
                <input type="text" name="endereco" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label class="form-label">Objetivo</label>
                <input type="text" name="objetivo" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <label class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Senha</label>
                <input type="password" name="password" class="form-control">
            </div>
        </div>
        <input type="hidden" name="tipo" value="3">
        <br>
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
</div>   
@endsection
@section('scripts')
{{ Html::script('js/mask.js'); }}
<script>
    $(document).ready(function($) {
        $('#telefone').mask('(00)00000-0000')
        $('#cpf').mask('000.000.000-00', {reverse: true});
    });
</script> 
@endsection