@extends('app._theme')
@section('content')
<div class="cadpessoa">
    <h1>Cadastrar rotina</h1>
    <form action="{{ route('rotinas.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <label class="form-label">Aluno</label>
                <select class="form-select" name="aluno" aria-label="Alunos">
                    <option selected>Selecione um aluno</option>
                    @if($alunos)
                    @foreach($alunos as $aluno)

                    <option value="{{ $aluno->id }}">{{ $aluno->name }}</option>

                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
</div>
@endsection