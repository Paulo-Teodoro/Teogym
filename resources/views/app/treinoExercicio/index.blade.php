@extends('app._theme')
@section('content')
<section class="section-alunos">
    <div class="row">
        <div class="col-md-6">
            <h2>Exercicios</h2>
        </div>
        <div class="col-md-6 align-buttons">
            <a href="{{ route('treinos.index', $rotina) }}" class="btn btn-warning">Voltar</a>    
        @if (!auth()->user()->is_aluno())
            <a href="{{ route('treino-exercicios.create', [$rotina,$treino] ) }}" class="btn btn-info"><i class="fas fa-plus"></i> Add exercicio</a>
        @endif
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col" class="d-none d-sm-block">Seq</th>
            <th scope="col">Exercicio</th>
            <th scope="col">Repetições</th>
            <th scope="col">Series</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
        
        @if($exercicios)
            @foreach($exercicios as $exercicio)
                <tr>
                    <th scope="row" class="d-none d-sm-block">{{ $exercicio->pivot->sequencia }}</th>
                    <td>{{ $exercicio->name }}</td>
                    <td>{{ $exercicio->pivot->repeticoes }}</td>
                    <td>{{ $exercicio->pivot->series }}</td>
                    <td>
                        <button type="button" class="btn delete" data-bs-toggle="modal" data-bs-target="#Modal{{ $exercicio->id }}"><i class="fas fa-trash-alt"></i></button>
                        <div class="modal fade" id="Modal{{ $exercicio->id }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Excluir exercicio</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Você tem certeza que deseja excluir o exercicio {{ $exercicio->name }}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form action="{{ route('treino-exercicios.destroy', [$rotina,$treino,$exercicio->id]) }}" method="POST"> 
                                        @csrf
                                        @method('DELETE')                                     
                                            <button type="submit" class="btn btn-danger">Excluir</button>
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
    @if (isset($filters))
        {!! $exercicios->appends($filters)->links() !!}      
    @else
        {!! $exercicios->links() !!}
    @endif
</section>   
@endsection