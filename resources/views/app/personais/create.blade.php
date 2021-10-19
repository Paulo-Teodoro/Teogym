@extends('app._theme')
@section('content')
<div class="cadpessoa">
    <h1>Cadastrar Personal</h1>
    <form action="{{ route('personais.store') }}" method="POST">
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
                <input type="text" name="cpf" id="cpf" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">telefone</label>
                <input type="text" name="telefone" id="telefone" class="form-control">
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
@section('scripts')
{{ Html::script('js/mask.js'); }}
<script>
    $(document).ready(function($) {
        $('#telefone').mask('(00)00000-0000')
        $('#cpf').mask('000.000.000-00', {reverse: true});
    });
</script> 
@endsection