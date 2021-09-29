@extends('app._theme')
@section('content')
<div class="cadpessoa">
    <h1>Editar Exercicio</h1>
    <form action="{{ route('exercicios.update', $exercicio->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <label class="form-label">Nome Exercicio</label>
                <input type="text" name="name" value="{{ $exercicio->name }}" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label class="form-label">Foco Exercicio</label>
                <input type="text" name="foco" value="{{ $exercicio->foco }}" class="form-control">
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Atualizar</button>
    </form>
</div>
@endsection