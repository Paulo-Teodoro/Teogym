@extends('app._theme')
@section('content')
<div class="cadpessoa">
    <h1>Cadastrar Exercicio no Treino {{ $treino->dia }}</h1>
    <form action="{{ route('treino-exercicios.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <label class="form-label">Exercicio</label>
                <select class="form-select" name="exercicio_id" aria-label="exercicio">
                    <option selected>Selecione um Exercicio</option>    
                    @if($exercicios)
                        @foreach($exercicios as $exercicio)
                            <option value="{{ $exercicio->id }}">{{ $exercicio->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label class="form-label">Repetições</label>
                <input type="number" name="repeticoes" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="form-label">Series</label>
                <input type="number" name="series" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="form-label">Sequencia</label>
                <input type="number" name="sequencia" class="form-control">
            </div>
        </div>
        <input type="hidden" name="rotina" value="{{ $rotina }}">
        <input type="hidden" name="treino_id" value="{{ $treino->id }}">
        <br>
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
</div>
 
@endsection