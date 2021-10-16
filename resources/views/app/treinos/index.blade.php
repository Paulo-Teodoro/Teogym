@extends('app._theme')
@section('content')
<section class="section-alunos">
    <div class="row">
        <div class="col-md-6">
            <h2>Treinos</h2>
        </div>
        <div class="col-md-6 align-buttons">
            <a href="{{ route('rotinas.index') }}" class="btn btn-warning">Voltar</a>
            <a href="{{ route('relatorios.rotina', $rotina->id) }}" target="_blank" class="btn btn-primary"><i class="fas fa-file-alt"></i> Imprimir</a>
        @if (!auth()->user()->is_aluno())
            <a href="{{ route('treinos.create', $rotina->id) }}" class="btn btn-info"><i class="fas fa-user-plus"></i> Add treino</a>
        @endif
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Dia</th>
            <th scope="col">Foco</th>
            <th scope="col">Operações</th>
        </tr>
        </thead>
        <tbody>
        @if($treinos)
            @foreach($treinos as $treino)
                <tr>
                    <th scope="row">{{ $treino->id }}</th>
                    <td>{{ $treino->dia }}</td>
                    <td>{{ $treino->foco }}</td>
                    <td>
                        <a href="{{ route('treino-exercicios.index', [$rotina->id, $treino->id]) }}" class="btn edit"><i class="fas fa-user-edit"></i></a>
                        <button type="button" class="btn delete" data-bs-toggle="modal" data-bs-target="#Modal{{ $treino->id; }}"><i class="fas fa-user-times"></i></button>
                        <div class="modal fade" id="Modal{{ $treino->id; }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Excluir treino</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Você tem certeza que deseja excluir a treino {{ $treino->nome; }}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form action="{{ route('treinos.destroy', [$rotina->id, $treino->id]) }}" method="POST">    
                                        @csrf
                                        @method('DELETE')                                            
                                            <button type="submit" class="btn btn-danger">Excluir</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</section>
@endsection