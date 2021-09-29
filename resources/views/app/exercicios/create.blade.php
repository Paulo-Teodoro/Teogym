@extends('app._theme')
@section('content')
<div class="cadpessoa">
    <h1>Cadastrar Exercicio</h1>
    <form action="{{ route("exercicios.store") }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <label class="form-label">Nome Exercicio</label>
                <input type="text" name="name" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label class="form-label">Foco Muscular</label>
                <input type="text" name="foco" class="form-control">
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
</div>
@endsection