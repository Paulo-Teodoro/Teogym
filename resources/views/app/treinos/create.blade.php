@extends('app._theme')
@section('content')
<div class="cadpessoa">
    <h1>Cadastrar treino</h1>
    <form action="{{ route('treinos.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <label class="form-label">Dia treino</label>
                <input type="text" name="dia" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label class="form-label">Foco Muscular</label>
                <input type="text" name="foco" class="form-control">
                <input type="hidden" name="rotina_id" value="{{ $rotina->id }}">
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
</div> 
@endsection